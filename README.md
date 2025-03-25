# OnePass - Secure Password Management API

## Overview

OnePass is a secure password management API that enables users to create, read, update, and delete their passwords in a zero-knowledge environment. All passwords are encrypted client-side before being sent to the server, ensuring maximum data confidentiality. The system includes advanced security features such as rate limiting, new device verification, IP management, and geographical restrictions.

## Features

### Core Functionality

- **Zero-Knowledge Password Storage**: All passwords are encrypted client-side before transmission
- **Complete Password Management**: Create, read, update, and delete password entries
- **Master Password Authentication**: Secure access using a single master password

### Security Features

- **Rate Limiting**: Limits login attempts to 10 per second with automatic blocking for 1 hour when exceeded
- **New Device Verification**: Email verification required when logging in from a new device
- **IP Management**:
  - User-defined whitelist of trusted IP addresses
  - Admin-managed blacklist of suspicious IP addresses
- **Geographical Restrictions**: Access limited to specified countries (e.g., Morocco, United States, Germany)
- **Secure Communications**: All API endpoints secured with SSL/TLS

## System Architecture

### Domain Model

The system is built around the following core entities:

- **User**: Manages account information and authentication
- **Password**: Stores encrypted password data with metadata
- **Device**: Tracks verified devices for each user
- **Session**: Manages active user sessions
- **IPManager**: Handles IP whitelisting and blacklisting

### Technology Stack

- **Backend**: Laravel (PHP Framework)
- **Database**: MySQL
- **Authentication**: Laravel Sanctum for API token authentication
- **Encryption**: AES-256 for password encryption
- **Email Service**: Laravel Mail with SMTP
- **Hosting**: AWS EC2, Azure VM, or DigitalOcean Droplet

## API Endpoints

### Authentication

- `POST /api/auth/register` - Create a new user account
- `POST /api/auth/login` - Authenticate with master password
- `POST /api/auth/verify-device` - Verify a new device
- `POST /api/auth/logout` - End the current session

### Password Management

- `GET /api/passwords` - Retrieve all passwords
- `GET /api/passwords/{id}` - Retrieve a specific password
- `POST /api/passwords` - Create a new password
- `PUT /api/passwords/{id}` - Update an existing password
- `DELETE /api/passwords/{id}` - Delete a password

### Security Management

- `GET /api/security/ip-whitelist` - Get user's IP whitelist
- `POST /api/security/ip-whitelist` - Add IP to whitelist
- `DELETE /api/security/ip-whitelist/{ip}` - Remove IP from whitelist
- `GET /api/security/allowed-countries` - Get allowed countries (admin)
- `PUT /api/security/allowed-countries` - Update allowed countries (admin)

## Setup Instructions

### Prerequisites

- PHP 8.0+
- Composer
- MySQL 5.7+
- Web server (Apache or Nginx)
- SSL certificate

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/onepass.git
   cd onepass