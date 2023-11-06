<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillData;
use Carbon\Carbon;
use GuzzleHttp\Client;
use SimpleXMLElement;
use Spatie\ArrayToXml\ArrayToXml;
use Symfony\Component\DomCrawler\Crawler;


class GetApiDataController extends Controller
{
    const USER = 'odatatest';
    const PASS = 'RpG~WU%nX';


    public function getXml(string $url): SimpleXMLElement
    {
        $client = new Client();

        $response = $client->request('GET', $url, [
            'auth' => [self::USER, self::PASS],
        ])->getBody()->getContents();


        return simplexml_load_string($response);
    }

    public function handle(): string
    {

        ini_set('max_execution_time', 1000);
        $url = 'https://ru.enote.link/08efd710-4709-478f-bac1-2d1b7e209599/odata/standard.odata/Document_ТоварныйЧек';
        BillData::query()->forceDelete();
        $parentXml = $this->getXml($url);
        $counterM = 0;
        $counterCh = 0;

        $elements = $parentXml->entry;

        foreach ($elements as $element) {
            Bill::updateOrInsert(
                ['href' => (string)$element->id],
            );
            $counterM++;
            $url1 = (string)$element->id;
            $child = $this->getXml(str_replace('http://', 'https://', $url1));
            $content = $child->content;
            $propertiesXml = $content->children('http://schemas.microsoft.com/ado/2007/08/dataservices/metadata');
            $data = $propertiesXml->children('d', true);


            $b = new BillData();
            foreach ((array)$data as $key => $value) {
                if ($value instanceof SimpleXMLElement) {
                    continue;
                }

                if (in_array($key, array_keys(BillData::$fields))) {
                    $b->{BillData::$fields[$key]} = $value;
                }

            }
            $b->save();
        }

        return 'Data is passed to database';
    }
}