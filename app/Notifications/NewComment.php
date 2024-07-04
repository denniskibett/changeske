<?

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    protected $point;
    protected $comment;

    public function __construct($point, $comment)
    {
        $this->point = $point;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "New comment on your point: '{$this->point->title}'",
            'point_id' => $this->point->id,
            'comment_id' => $this->comment->id,
        ];
    }
}
