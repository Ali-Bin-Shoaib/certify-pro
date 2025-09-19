# 🚀 Railway Deployment Guide

## Quick Deploy to Railway

### Step 1: Prepare Your Repository
1. Push your code to GitHub
2. Make sure all files are committed

### Step 2: Deploy to Railway
1. Go to [railway.app](https://railway.app)
2. Sign up with GitHub
3. Click "New Project"
4. Select "Deploy from GitHub repo"
5. Choose your repository
6. Railway will automatically detect it's a Laravel project

### Step 3: Add Database
1. In your Railway project dashboard
2. Click "New" → "Database" → "PostgreSQL"
3. Railway will automatically set up the database

### Step 4: Set Environment Variables
In Railway dashboard, go to your service → Variables tab:

```env
APP_NAME="Certify Pro"
APP_ENV=production
APP_KEY=your-generated-key
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app

DB_CONNECTION=pgsql
DB_HOST=${{RAILWAY_DATABASE_HOST}}
DB_PORT=${{RAILWAY_DATABASE_PORT}}
DB_DATABASE=${{RAILWAY_DATABASE_DB}}
DB_USERNAME=${{RAILWAY_DATABASE_USER}}
DB_PASSWORD=${{RAILWAY_DATABASE_PASSWORD}}

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Step 5: Generate APP_KEY
Run this command locally and copy the key:
```bash
php artisan key:generate --show
```

### Step 6: Deploy
Railway will automatically deploy when you push to GitHub!

## Alternative: Render Deployment

### Step 1: Go to Render
1. Visit [render.com](https://render.com)
2. Sign up with GitHub
3. Click "New" → "Web Service"

### Step 2: Connect Repository
1. Select your GitHub repository
2. Choose "Web Service"
3. Set build command: `composer install --no-dev --optimize-autoloader`
4. Set start command: `php artisan serve --host=0.0.0.0 --port=$PORT`

### Step 3: Add Database
1. Click "New" → "PostgreSQL"
2. Connect to your web service

### Step 4: Set Environment Variables
```env
APP_NAME="Certify Pro"
APP_ENV=production
APP_KEY=your-generated-key
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com

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

## Alternative: Heroku Deployment

### Step 1: Install Heroku CLI
```bash
curl https://cli-assets.heroku.com/install-ubuntu.sh | sh
```

### Step 2: Login and Deploy
```bash
heroku login
heroku create your-app-name
heroku addons:create heroku-postgresql:mini
git push heroku main
```

### Step 3: Set Environment Variables
```bash
heroku config:set APP_KEY=your-generated-key
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
```

## File Storage for Production

### Option 1: AWS S3 (Free Tier)
1. Create AWS account
2. Create S3 bucket
3. Set environment variables:
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

### Option 2: Cloudinary (Free Tier)
1. Create Cloudinary account
2. Install package: `composer require cloudinary/cloudinary_php`
3. Set environment variables:
```env
CLOUDINARY_URL=cloudinary://api_key:api_secret@cloud_name
```

## Troubleshooting

### Common Issues:
1. **Database connection** - Check environment variables
2. **File uploads** - Configure proper storage driver
3. **APP_KEY** - Generate and set properly
4. **HTTPS** - Ensure APP_URL uses https://

### Debug Commands:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## Recommended Stack

**Best Free Option:**
- **Hosting:** Railway or Render
- **Database:** PostgreSQL (included)
- **Storage:** AWS S3 (free tier)
- **CDN:** Cloudflare (free)

## Cost Comparison

| Platform | Free Tier | Database | Storage | Best For |
|----------|-----------|----------|---------|----------|
| Railway | $5/month credit | ✅ Included | ✅ Included | Laravel apps |
| Render | $7/month credit | ✅ Included | ✅ Included | Always-on apps |
| Heroku | Limited hours | ✅ Included | ✅ Included | Classic choice |
| Vercel | ❌ PHP issues | ❌ External needed | ❌ External needed | Not recommended |

## Next Steps

1. Choose Railway (recommended) or Render
2. Follow the deployment steps
3. Set up file storage (AWS S3)
4. Test your application
5. Configure custom domain (optional)
