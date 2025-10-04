#!/usr/bin/env php
<?php

/**
 * ==============================================================================
 * Database Export Script for Laravel
 * ==============================================================================
 * This script exports your local database to a SQL file for deployment
 * Usage: php deployment/scripts/export-database.php
 * ==============================================================================
 */

define('LARAVEL_START', microtime(true));

// Determine Laravel base path
$basePath = dirname(__DIR__, 2);

// Load the application
require $basePath.'/vendor/autoload.php';

$app = require_once $basePath.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

// ==============================================================================
// Colors for CLI output
// ==============================================================================

class ConsoleColors
{
    private $foreground_colors = [
        'black' => '0;30',
        'red' => '0;31',
        'green' => '0;32',
        'yellow' => '1;33',
        'blue' => '0;34',
        'cyan' => '0;36',
        'white' => '1;37',
    ];

    public function getColoredString($string, $foreground_color = null)
    {
        $colored_string = "";
        if (isset($this->foreground_colors[$foreground_color])) {
            $colored_string .= "\033[".$this->foreground_colors[$foreground_color]."m";
        }
        $colored_string .= $string."\033[0m";

        return $colored_string;
    }
}

$colors = new ConsoleColors();

// ==============================================================================
// Helper Functions
// ==============================================================================

function printHeader($message)
{
    global $colors;
    echo "\n";
    echo $colors->getColoredString("========================================\n", 'blue');
    echo $colors->getColoredString("  $message\n", 'blue');
    echo $colors->getColoredString("========================================\n", 'blue');
    echo "\n";
}

function printSuccess($message)
{
    global $colors;
    echo $colors->getColoredString("✓ $message\n", 'green');
}

function printError($message)
{
    global $colors;
    echo $colors->getColoredString("✗ $message\n", 'red');
}

function printWarning($message)
{
    global $colors;
    echo $colors->getColoredString("⚠ $message\n", 'yellow');
}

function printInfo($message)
{
    global $colors;
    echo $colors->getColoredString("ℹ $message\n", 'cyan');
}

// ==============================================================================
// Main Script
// ==============================================================================

printHeader("Database Export Script");

try {
    // Get database configuration
    $connection = Config::get('database.default');
    $driver = Config::get("database.connections.{$connection}.driver");
    $database = Config::get("database.connections.{$connection}.database");
    $host = Config::get("database.connections.{$connection}.host");
    $port = Config::get("database.connections.{$connection}.port");
    $username = Config::get("database.connections.{$connection}.username");
    $password = Config::get("database.connections.{$connection}.password");

    printInfo("Connection: $connection");
    printInfo("Driver: $driver");
    printInfo("Database: $database");
    printInfo("Host: $host");

    // Check if SQLite
    if ($driver === 'sqlite') {
        printInfo("Detected SQLite database");

        $sqliteDb = $database;
        if (! file_exists($sqliteDb)) {
            printError("SQLite database file not found: $sqliteDb");
            exit(1);
        }

        // For SQLite, we'll use sqlite3 command if available
        $outputFile = $basePath.'/database_export_'.date('Y-m-d_His').'.sql';

        printInfo("Exporting to: $outputFile");

        // Try to use sqlite3 command
        $command = "sqlite3 {$sqliteDb} .dump > {$outputFile}";
        exec($command, $output, $return_var);

        if ($return_var !== 0) {
            printWarning("sqlite3 command failed. Trying PHP method...");

            // Fallback: Copy the SQLite file
            $outputFile = $basePath.'/database_export_'.date('Y-m-d_His').'.sqlite';
            copy($sqliteDb, $outputFile);
            printSuccess("SQLite database copied to: $outputFile");

            printInfo("\nTo import on server:");
            echo "  1. Upload this file to your server\n";
            echo "  2. Place it in the database/ directory\n";
            echo "  3. Update .env to point to this file\n\n";
            exit(0);
        }

        printSuccess("Database exported successfully!");
        printInfo("File: $outputFile");

        printInfo("\nTo import on server:");
        echo "  1. Upload the SQL file to your server\n";
        echo "  2. Run: sqlite3 database/database.sqlite < $outputFile\n\n";
        exit(0);
    }

    // Check if MySQL/MariaDB
    if ($driver === 'mysql' || $driver === 'mariadb') {
        printInfo("Detected MySQL/MariaDB database");

        // Check if mysqldump is available
        exec('which mysqldump', $output, $return_var);
        if ($return_var !== 0) {
            printError("mysqldump command not found!");
            printWarning("Please install MySQL client tools or export manually from phpMyAdmin");
            exit(1);
        }

        $outputFile = $basePath.'/database_export_'.date('Y-m-d_His').'.sql';

        printInfo("Exporting to: $outputFile");

        // Build mysqldump command
        $command = sprintf(
            'mysqldump -h%s -P%s -u%s %s %s > %s',
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            $password ? '-p'.escapeshellarg($password) : '',
            escapeshellarg($database),
            escapeshellarg($outputFile)
        );

        // Execute
        exec($command, $output, $return_var);

        if ($return_var !== 0) {
            printError("Export failed!");
            printWarning("You may need to export manually from phpMyAdmin or use:");
            echo "  mysqldump -u{$username} -p {$database} > database_export.sql\n\n";
            exit(1);
        }

        printSuccess("Database exported successfully!");
        printInfo("File: $outputFile");

        // Get file size
        $fileSize = filesize($outputFile);
        $fileSizeMB = round($fileSize / 1024 / 1024, 2);
        printInfo("Size: {$fileSizeMB} MB");

        printInfo("\nTo import on server:");
        echo "  Via SSH:\n";
        echo "    mysql -u your_user -p your_database < ".basename($outputFile)."\n\n";
        echo "  Via phpMyAdmin:\n";
        echo "    1. Login to phpMyAdmin\n";
        echo "    2. Select your database\n";
        echo "    3. Click 'Import' tab\n";
        echo "    4. Choose this file and click 'Go'\n\n";

        if ($fileSizeMB > 50) {
            printWarning("File is large! You may need to:");
            echo "  - Increase upload_max_filesize in php.ini\n";
            echo "  - Use SSH import method instead\n";
            echo "  - Split the file into smaller parts\n\n";
        }

        exit(0);
    }

    // Check if PostgreSQL
    if ($driver === 'pgsql') {
        printInfo("Detected PostgreSQL database");

        printWarning("PostgreSQL export not automated yet.");
        printInfo("Please use pg_dump manually:");
        echo "  pg_dump -U {$username} -h {$host} {$database} > database_export.sql\n\n";
        exit(1);
    }

    printError("Unsupported database driver: $driver");
    exit(1);
} catch (\Exception $e) {
    printError("An error occurred: ".$e->getMessage());
    printInfo("\nStack trace:");
    echo $e->getTraceAsString()."\n";
    exit(1);
}

