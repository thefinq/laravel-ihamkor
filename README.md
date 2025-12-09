# i-Hamkor Laravel Package

Laravel package for i-Hamkor API integration.

## Requirements

- PHP 8.3+
- Laravel 11.x or 12.x

## Installation

Install the package via Composer:

```bash
composer require finq/ihamkor
```

The package will automatically register its service provider.

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=ihamkor-config
```

Add the following environment variables to your `.env` file:

```env
IHAMKOR_URL=https://api.i-hamkor.uz/
IHAMKOR_CLIENT_ID=your-client-id
IHAMKOR_USERNAME=your-username
IHAMKOR_PASSWORD=your-password
IHAMKOR_TIMEOUT=30
IHAMKOR_RETRY_TIMES=3
IHAMKOR_RETRY_SLEEP=100
```

## Usage

### Using the Facade

```php
use Finq\Ihamkor\Facades\Ihamkor;

// Get taxi income data
$response = Ihamkor::taxiIncome($pinfl, $signature);

// Register user verification
$response = Ihamkor::registerMyId($pinfl, $job_id);

// Get person info
$response = Ihamkor::getPersonInfo($pinfl, $signature);
```

### Using Dependency Injection

```php
use Finq\Ihamkor\IhamkorService;

class YourController extends Controller
{
    public function __construct(
        protected IhamkorService $ihamkor
    ) {}

    public function index()
    {
        $response = $this->ihamkor->taxiIncome($pinfl, $signature);
        
        if ($response->successful()) {
            return $response->json();
        }
        
        return response()->json(['error' => 'Request failed'], 500);
    }
}
```

### Handling Responses

```php
use Finq\Ihamkor\Facades\Ihamkor;

$response = Ihamkor::taxiIncome($pinfl, $signature);

// Check if request was successful
if ($response->successful()) {
    $data = $response->json();
}

// Check for specific status codes
if ($response->status() === 200) {
    // Handle success
}

// Get response body as array
$data = $response->json();

// Get response body as string
$body = $response->body();
```

## Available Methods

| Method | Description |
|--------|-------------|
| `taxiIncome(string $pinfl, string $signature)` | Get taxi income data from GNK marketplace |
| `registerMyId(string $pinfl, string $job_id)` | Register user verification via MyID |
| `getPersonInfo(string $pinfl, string $signature)` | Get person info by PINFL |
| `getClient()` | Get the underlying HTTP client |

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
