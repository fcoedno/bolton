<?php

declare(strict_types=1);

namespace Bolton\Invoice\Infrastructure\InvoiceSource\ArquiveiAPI\Mock;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class MockInvoiceXmlProvider
{
    /**
     * @return array<array>
     */
    public function getAll(): array
    {
        $data = [];
        $files = Finder::create()
            ->in(__DIR__ . '/../../../../../../resources/invoices')
            ->sortByName()
            ->files();
        /** @var SplFileInfo $file */
        foreach ($files as $key => $file) {
            $accessKey = basename($key, '.xml');
            $data[] = [
                'access_key' => $accessKey,
                'xml' => base64_encode($file->getContents()),
            ];
        }
        return $data;
    }
}
