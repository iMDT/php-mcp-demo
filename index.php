<?php
declare(strict_types=1);

chdir(__DIR__);
require_once 'vendor/autoload.php';
require_once 'src/McpElements.php';

use PhpMcp\Server\Server;
use PhpMcp\Server\Transports\StdioServerTransport;
use Psr\Log\AbstractLogger;
use PhpMcp\Server\Transports\StreamableHttpServerTransport;

class StderrLogger extends AbstractLogger
{
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        fwrite(STDERR, sprintf(
            "[%s] %s %s\n",
            strtoupper($level),
            $message,
            empty($context) ? '' : json_encode($context)
        ));
    }
}

$logger = new StderrLogger();

$server = Server::make()
    ->withServerInfo('Streamable Server', '1.0.0')
    ->withLogger($logger)
    // ->withCache($cache)     // Required for resumability
    ->build();

    $server->discover(__DIR__, ['src']);

// Create streamable transport with resumability
$transport = new StreamableHttpServerTransport(
    host: '127.0.0.1',      // MCP protocol prohibits 0.0.0.0
    port: 8080,
    // mcpPathPrefix: 'mcp',
    enableJsonResponse: false,  // Use SSE streaming (default)
    stateless: false            // Enable stateless mode for session-less clients
);

$server->listen($transport);
