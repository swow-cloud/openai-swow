<?php

use Swow\Socket;
use SwowCloud\OpenAI\OpenAI;

require_once __DIR__ . '/../vendor/autoload.php';

class OpenAIExample
{
    public function __construct(
        private readonly string $key = 'your api key',
        public Socket $input = (new Socket(Socket::TYPE_STDIN)),
        public Socket $output = new Socket(Socket::TYPE_STDOUT),
        public Socket $error = new Socket(Socket::TYPE_STDERR),
    ) {
        $yourApiKey = '';
    }

    public function start()
    {
        $client = OpenAI::client($this->key)->chat();

        $this->input->setReadTimeout(-1);
        $this->out('请输入你想要咨询的问题!');


        while ($in = $this->in()) {
            if ($in === "\n") {
                continue;
//                $in = $this->getLastCommand();
            }
            /** @var \SwowCloud\OpenAI\Responses\Chat\CreateResponse $response */
            $response = $client->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => rtrim($in, "\n")],
                ],
            ]);
            $content = $response->offsetGet('choices')[0]['message']['content'] ?? 'chapgpt返回响应异常';
            $this->out($content);
        }
    }

    public function in(bool $prefix = true): string
    {
        if ($prefix) {
            $this->out("\r> ", false);
        }

        return $this->input->recvString();
    }

    public function out(string $string = '', bool $newline = true): static
    {
        $this->output->write([$string, $newline ? "\n" : null]);

        return $this;
    }
}

$example = new OpenAIExample();
$example->start();




