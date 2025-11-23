<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Helpers\ChatActor;

class ChatConversations
{
    /**
     * Get or create conversation between the logged-in student and their assigned center.
     * Returns conversation id (int) or throws.
     */
    public static function getOrCreateStudentCenterConversation(): int
    {
        $actor = ChatActor::current();
        if (! $actor || $actor['type'] !== 'student_login') {
            abort(403, 'Only students can create student-center conversation via this helper');
        }

        $studentId = (int)$actor['id'];

        $row = DB::selectOne("SELECT sl_FK_of_center_id as center_id FROM student_login WHERE sl_id = ?", [$studentId]);
        if (! $row || ! $row->center_id) {
            abort(404, 'Assigned center not found for this student.');
        }
        $centerId = (int)$row->center_id;

        // find existing
        $sql = "
          SELECT c.id FROM conversations c
          JOIN conversation_participants p1 ON p1.conversation_id = c.id AND p1.participant_type='student_login' AND p1.participant_id = ?
          JOIN conversation_participants p2 ON p2.conversation_id = c.id AND p2.participant_type='center_login' AND p2.participant_id = ?
          WHERE c.type = 'student_center'
          LIMIT 1
        ";
        $existing = DB::selectOne($sql, [$studentId, $centerId]);
        if ($existing) return (int)$existing->id;

        DB::insert("INSERT INTO conversations (`type`, `created_at`) VALUES (?, ?)", ['student_center', now()->toDateTimeString()]);
        $convId = DB::getPdo()->lastInsertId();

        DB::insert("INSERT INTO conversation_participants (conversation_id, participant_id, participant_type, created_at) VALUES (?, ?, ?, ?)",
            [$convId, $studentId, 'student_login', now()->toDateTimeString()]);

        DB::insert("INSERT INTO conversation_participants (conversation_id, participant_id, participant_type, created_at) VALUES (?, ?, ?, ?)",
            [$convId, $centerId, 'center_login', now()->toDateTimeString()]);

        return (int)$convId;
    }

    /**
     * Get or create conversation between center and admin.
     * If $adminId omitted, the first admin is used.
     */
    public static function getOrCreateCenterAdminConversation(int $centerId, ?int $adminId = null): int
    {
        if (! $adminId) {
            $a = DB::selectOne("SELECT al_id FROM admin_login ORDER BY al_id ASC LIMIT 1");
            if (! $a) abort(404, 'No admin found.');
            $adminId = (int)$a->al_id;
        }

        $existing = DB::selectOne("
            SELECT c.id FROM conversations c
            JOIN conversation_participants p1 ON p1.conversation_id = c.id AND p1.participant_type='center_login' AND p1.participant_id = ?
            JOIN conversation_participants p2 ON p2.conversation_id = c.id AND p2.participant_type='admin_login' AND p2.participant_id = ?
            WHERE c.type = 'center_admin'
            LIMIT 1
        ", [$centerId, $adminId]);

        if ($existing) return (int)$existing->id;

        DB::insert("INSERT INTO conversations (`type`,`created_at`) VALUES (?, ?)", ['center_admin', now()->toDateTimeString()]);
        $convId = DB::getPdo()->lastInsertId();

        DB::insert("INSERT INTO conversation_participants (conversation_id, participant_id, participant_type, created_at) VALUES (?, ?, ?, ?)",
            [$convId, $centerId, 'center_login', now()->toDateTimeString()]);

        DB::insert("INSERT INTO conversation_participants (conversation_id, participant_id, participant_type, created_at) VALUES (?, ?, ?, ?)",
            [$convId, $adminId, 'admin_login', now()->toDateTimeString()]);

        return (int)$convId;
    }
}
