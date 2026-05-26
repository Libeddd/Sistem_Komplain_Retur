<?php

namespace App\Enums;

enum ComplaintStatus: string {
    case Pending              = 'pending';
    case InReview             = 'in_review';
    case ApprovedMenungguResi = 'approved_menunggu_resi';
    case InProgress           = 'in_progress';
    case Done                 = 'done';
    case Rejected             = 'rejected';
}
