<?PHP

namespace MeridienClube\Meridien\Services\Integrations;

use MeridienClube\Meridien\Services\Contracts\IntegrationContract;

class JsonService implements IntegrationContract
{
    protected $data = [];
    protected $file_get_contents = [];
    protected $json_decode = [];

    public function set(Array $data)
    {
        $this->data = $data;
        $this->file_get_contents = isset($this->data['url']) ? file_get_contents($this->data['url'], true) : null;
        $this->json_decode = json_decode($this->file_get_contents, true);
    }

    public function get()
    {
        $userCollect = [];
        foreach($this->json_decode as $jDecode){
            $userCollect[] = array_merge($this->data, $jDecode);
        }
        return collect($userCollect);
    }

    public function fields()
    {
        return collect(isset($this->json_decode[0]) ? array_keys($this->json_decode[0]) : null)->mapWithKeys(function ($item) {
            return [strtolower($item) => __(ucfirst($item))];
        });
    }

    public function test()
    {
        return ($this->file_get_contents) ? true : false;
    }
}
