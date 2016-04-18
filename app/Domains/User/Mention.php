<?php
/**
 * This file is part of GitterBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 14.04.2016 2:02
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\User;

use Doctrine\ORM\Mapping as ORM;
use Domains\Message\Message;
use EndyJasmi\Cuid;
use Serafim\Properties\Getters;

/**
 * Class Mention
 * @package Domains\User
 * @ORM\Entity
 * @ORM\Table(name="mentions")
 * @property-read string $id
 * @property-read User $creator
 * @property-read User $target
 * @property-read Message $message
 */
class Mention
{
    use Getters;

    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mentions", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="user_id")
     */
    protected $creator;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mentioned", cascade={"persist", "merge"}, fetch="EAGER")
     * @ORM\JoinColumn(name="user_target_id")
     */
    protected $target;

    /**
     * @var Message
     * @ORM\ManyToOne(targetEntity=Message::class, inversedBy="mentions", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="message_id")
     */
    protected $message;

    /**
     * Mention constructor.
     * @param User $mentions
     * @param Message $inMessage
     */
    public function __construct(User $mentions, Message $inMessage)
    {
        $this->id = Cuid::cuid();
        $this->creator = $inMessage->user;
        $this->target = $mentions;
        $this->message = $inMessage;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isMentionOf(User $user) : bool
    {
        return $this->target->id === $user->id;
    }
}
