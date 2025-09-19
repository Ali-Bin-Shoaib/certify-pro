# 🚀 Deployment Guide for Certify Pro

## Quick Deploy Options

### 1. Vercel (Recommended - Already Configured!)

**Prerequisites:**
```bash
npm install -g vercel
```

**Deploy:**
```bash
vercel --prod
```

**Environment Variables to Set:**
- `APP_KEY` - Generate with: `php artisan key:generate --show`
- `DB_CONNECTION` - Set to `pgsql` or `mysql`
- `DB_HOST` - Your database host
- `DB_DATABASE` - Your database name
- `DB_USERNAME` - Your database username
- `DB_PASSWORD` - Your database password

### 2. Heroku (Also Pre-configured!)

**Prerequisites:**
```bash
# Install Heroku CLI
curl https://cli-assets.heroku.com/install-ubuntu.sh | sh
```

**Deploy:**
```bash
heroku login
heroku create your-app-name
heroku addons:create heroku-postgresql:mini
git add .
git commit -m "Deploy to Heroku"
git push heroku main
```

### 3. Railway (Best for Laravel + Database)

1. Go to [railway.app](https://railway.app)
2. Connect GitHub repository
3. Add PostgreSQL database
4. Set environment variables
5. Deploy automatically

### 4. Render (Great Free Tier)

1. Go to [render.com](https://render.com)
2. Connect GitHub repository
3. Choose "Web Service"
4. Add PostgreSQL database
5. Configure build command: `composer install --no-dev --optimize-autoloader`

## Pre-Deployment Checklist

### 1. Environment Variables
Create `.env.production` with:
```env
APP_NAME="Certify Pro"
APP_ENV=production
APP_KEY=your-generated-key
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=pgsql
DB_HOST=your-db-host
DB_PORT=5432
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### 2. Generate Application Key
```bash
php artisan key:generate --show
```

### 3. Database Migration
```bash
php artisan migrate --force
```

### 4. Storage Link (if using local storage)
```bash
php artisan storage:link
```

### 5. Clear Caches
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Database Options

### Free Database Providers:
1. **Railway PostgreSQL** - Free tier available
2. **Heroku Postgres** - Free tier available
3. **PlanetScale MySQL** - Free tier available
4. **Supabase PostgreSQL** - Free tier available

## File Storage Options

### For Production:
1. **AWS S3** - Free tier available
2. **Cloudinary** - Free tier available
3. **DigitalOcean Spaces** - $5/month
4. **Local storage** - Works but not recommended for production

## Recommended Stack

**Best Free Option:**
- **Hosting:** Railway or Render
- **Database:** PostgreSQL (Railway/Heroku)
- **Storage:** AWS S3 (free tier)
- **CDN:** Cloudflare (free)

## Troubleshooting

### Common Issues:
1. **Storage permissions** - Ensure storage directory is writable
2. **Database connection** - Check environment variables
3. **File uploads** - Configure proper storage driver
4. **HTTPS** - Ensure APP_URL uses https://

### Debug Commands:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Security Checklist

- [ ] Set `APP_DEBUG=false`
- [ ] Use strong `APP_KEY`
- [ ] Configure proper database credentials
- [ ] Set up HTTPS
- [ ] Configure proper file permissions
- [ ] Set up proper CORS settings
