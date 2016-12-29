<?php declare(strict_types = 1);
/**
 * This file is part of Laravel-Karma package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace KarmaBot\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Container\Container;
use KarmaBot\Model\Channel;
use Serafim\KarmaCore\System\Gitter\GitterSystem;

/**
 * Class BotChannelAdd
 * @package KarmaBot\Console\Commands
 */
class BotChannelSyncMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:messages:sync 
        {channelId : Channel identifier}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load all messages from target channel';

    /**
     * Execute the console command.
     *
     * @param Container $container
     * @return void
     * @throws \InvalidArgumentException
     */
    public function handle(Container $container): void
    {
        $channel = Channel::find($this->argument('channelId'));
        if (!$channel) {
            throw new \InvalidArgumentException('Invalid channel id');
        }

        $conn = $channel->getChannelConnection($container);


        foreach ($conn->messages() as $message) {

        }
    }
}