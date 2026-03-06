# Backup Quick Reference Guide

Quick commands for common backup operations.

## Quick Commands

### Create Backups

```bash
# Full backup (files + database)
php artisan backup:run

# Database only
php artisan backup:run --only-db

# Files only
php artisan backup:run --only-files

# With detailed output
php artisan backup:run --verbose
```

### View Backups

```bash
# List all backups
php artisan backup:list

# Check location
ls -lah storage/app/private/Laravel/

# Check disk usage
du -sh storage/app/private/Laravel/
```

### Monitor Health

```bash
# Check backup status
php artisan backup:monitor

# Clean old backups (based on retention policy)
php artisan backup:clean

# Clean with details
php artisan backup:clean --verbose
```

### Run Tests

```bash
# Test backup system
php artisan test --filter=BackupTest --compact
```

---

## Emergency Restore (Quick Steps)

### If you lost data:

```bash
# 1. Find latest backup
ls -ltrh storage/app/private/Laravel/ | tail -1

# 2. Extract it
unzip storage/app/private/Laravel/BACKUP_FILE.zip -d /tmp/restore

# 3. Get the database dump
cd /tmp/restore
gunzip -c database-*.sql.gz > database.sql

# 4. Restore the database
mysql -u root -p db-laziznubjn < database.sql

# 5. Clear cache
php artisan cache:clear

# Done!
```

---

## Automation

Add to your system crontab for automatic backups:

```bash
# Edit crontab
crontab -e

# Add these three lines:
0 2 * * * cd /path/to/laziznu-bjn && php artisan backup:run >> /dev/null 2>&1
0 3 * * * cd /path/to/laziznu-bjn && php artisan backup:clean >> /dev/null 2>&1
0 * * * * cd /path/to/laziznu-bjn && php artisan backup:monitor >> /dev/null 2>&1
```

This runs:

- **2 AM**: Daily backup
- **3 AM**: Cleanup old backups
- **Every hour**: Monitor health

---

## Backup File Locations

```
Primary: storage/app/private/Laravel/
├── 2026-03-06-05-36-30.zip    ← Full backup (files + database)
├── 2026-03-06-00-32-28.zip
└── ...

Inside backup.zip:
├── database-2026-03-06-05-36-30.sql.gz  ← Compressed database dump
├── yourapp/                              ← Application files
└── manifest.json                         ← Metadata
```

---

## Configuration

See: [config/backup.php](config/backup.php)

**Key configs:**

- Database: MySQL ✅
- Compression: Gzip ✅
- Retention: 14 days full, then intelligent cleanup ✅
- Storage: Local disk (10GB max) ✅

---

## Documentation

- **Full Guide**: [BACKUP_AND_RESTORE.md](BACKUP_AND_RESTORE.md)
- **Status**: [SETUP_COMPLETE.md](SETUP_COMPLETE.md)
- **Config**: [config/backup.php](config/backup.php)
- **Tests**: [tests/Feature/Features/BackupTest.php](tests/Feature/Features/BackupTest.php)

---

## Troubleshooting

**Backup too slow?**

- Use `--only-db` to backup only database
- Check disk I/O: `iostat 1 5`

**Backup failed?**

- Check disk space: `df -h`
- Check MySQL running: `mysql -u root -p -e "SHOW DATABASES;"`
- Check logs: `tail -f storage/logs/laravel.log`

**Restore failed?**

- Verify backup file: `unzip -t storage/app/private/Laravel/*.zip`
- Check MySQL password in .env
- Ensure target database exists

**Disk space full?**

- Clean old backups: `php artisan backup:clean`
- Or: `rm storage/app/private/Laravel/old-backup.zip`

---

## Important Notes

⚠️ **Before production**:

- [ ] Test a restore from actual backup
- [ ] Verify backup size matches expectations
- [ ] Check backup schedule is running
- [ ] Monitor disk usage regularly
- [ ] Keep backups in safe location

✅ **Already done for you**:

- [x] Backup system installed and configured
- [x] CSRF protection verified on all forms
- [x] Automated tests created and passing
- [x] Documentation complete
- [x] Health monitoring active

---

**Last Updated**: March 6, 2026
**Status**: ✅ Complete & Ready to Use
