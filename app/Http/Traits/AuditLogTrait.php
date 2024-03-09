<?php

namespace App\Http\Traits;

use \App\Models\AuditLog as AuditLogTBL;

trait AuditLogTrait {
    public function auditLog($id, $activity){
        $log = AuditLogTBL::create([
            'interns_id' => $id,
            'activity' => $activity
        ]);
        if(!$log)return false;
        return true;
    }
}
