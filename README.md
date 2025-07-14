# PHP MCP Demo

A demonstration project showcasing a Model Context Protocol (MCP) server implementation in PHP, featuring a calculator service with configurable settings and employee data management.

## Requirements

- PHP 8.0 or higher
- Composer

## Installation

1. Clone this repository:

```bash
git clone <repository-url>
cd php-mcp-demo
```

2. Install dependencies:

```bash
composer install
```

## Usage

### Starting the Server

Run the MCP server:

```bash
php index.php
```

It will be available at: `http://127.0.0.1:8080`;

### Connect MCP to Claude (Anthropic)

Want to use this server with Claude or any AI that supports MCP? Follow these steps:

1. Expose the local server using ngrok:

```bash
ngrok http 8080

```

2. Copy the ngrok URL (e.g., <https://abc123.ngrok.io>)
3. Create a connector in Claude pointing to:

```
https://abc123.ngrok.io/mcp

```

Done! You can now use the calculator and employee tools directly via Claude.
