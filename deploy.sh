#!/usr/bin/env bash
set -euo pipefail

export PATH="/opt/cpanel/composer/bin:/usr/local/bin:/usr/bin:${HOME:-/home/stuw8183}/bin:$PATH"

REPO_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
TARGET_DIR="${PUBLIC_HTML_DIR:-/home/stuw8183/public_html}"

cd "$REPO_DIR"

echo "==> [1/6] Sinkronisasi kode terbaru dari branch main..."
git fetch origin main
git reset --hard origin/main

# Lindungi folder repository di dalam public_html/repositories/studio-pasti dari akses browser
if [ ! -f "$REPO_DIR/.htaccess" ]; then
    cat > "$REPO_DIR/.htaccess" <<'EOF'
<IfModule mod_authz_core.c>
    Require all denied
</IfModule>
<IfModule !mod_authz_core.c>
    Order allow,deny
    Deny from all
</IfModule>
EOF
fi

echo "==> [2/6] Memasang dependensi Composer produksi..."
PHP_BIN="php"
for candidate_php in /opt/cpanel/ea-php83/root/usr/bin/php /opt/cpanel/ea-php82/root/usr/bin/php /usr/local/bin/php "$(command -v php || true)"; do
    if [ -n "$candidate_php" ] && [ -x "$candidate_php" ]; then
        PHP_BIN="$candidate_php"
        break
    fi
done

COMPOSER_CMD=()
if command -v composer >/dev/null 2>&1; then
    COMPOSER_CMD=("$(command -v composer)")
elif [ -x /opt/cpanel/composer/bin/composer ]; then
    COMPOSER_CMD=("/opt/cpanel/composer/bin/composer")
elif [ -x /usr/local/bin/composer ]; then
    COMPOSER_CMD=("/usr/local/bin/composer")
elif [ -x /usr/bin/composer ]; then
    COMPOSER_CMD=("/usr/bin/composer")
elif [ -f "${HOME:-/home/stuw8183}/composer.phar" ]; then
    COMPOSER_CMD=("$PHP_BIN" "${HOME:-/home/stuw8183}/composer.phar")
elif [ -f "$REPO_DIR/composer.phar" ]; then
    COMPOSER_CMD=("$PHP_BIN" "$REPO_DIR/composer.phar")
fi

if [ ${#COMPOSER_CMD[@]} -gt 0 ]; then
    "${COMPOSER_CMD[@]}" install --no-dev --prefer-dist --no-interaction --optimize-autoloader || true
elif [ ! -f "$TARGET_DIR/vendor/autoload.php" ]; then
    echo "INFO: Composer tidak ditemukan, mengunduh composer.phar..."
    if command -v curl >/dev/null 2>&1; then
        curl -sS https://getcomposer.org/installer | "$PHP_BIN" -- --install-dir="$REPO_DIR" --filename=composer.phar || true
    fi
    if [ -f "$REPO_DIR/composer.phar" ]; then
        "$PHP_BIN" "$REPO_DIR/composer.phar" install --no-dev --prefer-dist --no-interaction --optimize-autoloader || true
    else
        echo "ERROR: Composer tidak tersedia dan $TARGET_DIR/vendor/autoload.php tidak ditemukan." >&2
        exit 1
    fi
else
    echo "INFO: Mempertahankan folder vendor/ yang sudah ada di $TARGET_DIR/vendor"
fi

echo "==> [3/6] Menyinkronkan file Studio PASTI ke $TARGET_DIR..."
mkdir -p "$TARGET_DIR"

if command -v rsync >/dev/null 2>&1; then
    rsync -a --delete "$REPO_DIR/app/" "$TARGET_DIR/app/"
    if [ -f "$REPO_DIR/vendor/autoload.php" ]; then
        rsync -a --delete "$REPO_DIR/vendor/" "$TARGET_DIR/vendor/"
    fi
    rsync -a --exclude='uploads/' --exclude='.htaccess' "$REPO_DIR/public/" "$TARGET_DIR/"
else
    rm -rf "$TARGET_DIR/app"
    cp -a "$REPO_DIR/app" "$TARGET_DIR/app"
    if [ -f "$REPO_DIR/vendor/autoload.php" ]; then
        rm -rf "$TARGET_DIR/vendor"
        cp -a "$REPO_DIR/vendor" "$TARGET_DIR/vendor"
    fi
    for item in "$REPO_DIR/public/"* "$REPO_DIR/public/".[!.]*; do
        [ -e "$item" ] || continue
        base="$(basename "$item")"
        if [ "$base" = "uploads" ] || [ "$base" = ".htaccess" ]; then
            continue
        fi
        cp -rf "$item" "$TARGET_DIR/"
    done
fi

for root_file in composer.json composer.lock spark preload.php; do
    if [ -f "$REPO_DIR/$root_file" ]; then
        cp -f "$REPO_DIR/$root_file" "$TARGET_DIR/$root_file"
    fi
done

# Salin .htaccess hanya jika belum ada di public_html agar aturan MultiPHP cPanel tidak tertimpa
if [ ! -f "$TARGET_DIR/.htaccess" ] && [ -f "$REPO_DIR/public/.htaccess" ]; then
    cp -f "$REPO_DIR/public/.htaccess" "$TARGET_DIR/.htaccess"
fi

echo "==> [4/6] Memastikan direktori uploads & writable tersedia..."
mkdir -p \
    "$TARGET_DIR/uploads/portfolios" \
    "$TARGET_DIR/writable/cache" \
    "$TARGET_DIR/writable/logs" \
    "$TARGET_DIR/writable/session" \
    "$TARGET_DIR/writable/uploads" \
    "$TARGET_DIR/writable/debugbar"

if [ ! -f "$TARGET_DIR/uploads/portfolios/default.png" ] && [ -f "$TARGET_DIR/PASTI - Icon.png" ]; then
    cp "$TARGET_DIR/PASTI - Icon.png" "$TARGET_DIR/uploads/portfolios/default.png"
fi

echo "==> [5/6] Membersihkan cache CodeIgniter 4..."
if [ -f "$TARGET_DIR/spark" ]; then
    (cd "$TARGET_DIR" && "$PHP_BIN" spark cache:clear) || true
fi
find "$TARGET_DIR/writable/cache" -mindepth 1 ! -name 'index.html' ! -name '.htaccess' -delete 2>/dev/null || true

echo "==> [6/6] Menyesuaikan hak akses direktori..."
chmod -R 775 "$TARGET_DIR/writable" "$TARGET_DIR/uploads" || true

echo "==> Deploy Studio PASTI ke $TARGET_DIR selesai!"
