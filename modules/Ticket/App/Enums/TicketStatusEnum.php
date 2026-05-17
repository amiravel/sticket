<?php

namespace Modules\Ticket\App\Enums;

use App\Enums\EnumMethods;

enum TicketStatusEnum: string
{

    use EnumMethods;

    case pending = 'pending';

    case read = 'read';

    case approved_1 = '1st stage approved';

    case approved_2 = '2nd stage approved';

    case rejected = 'rejected';

}
