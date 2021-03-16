<?

class CounterAgent{
    static function CheckUserCount($lastDate = 0, $prevUsers = 0)
    {

        $usersCounter = new CounterAgent();
        $date = ConvertTimeStamp(time(), "FULL");
        if ($lastDate) {
            $filter = array(
                'USER.ACTIVE' => 'Y',
                'DATE_REGISTER_1' => $lastDate,
                'DATE_REGISTER_2' => $date,
            );
        } else {
            $filter = array('USER.ACTIVE' => 'Y');
        }

        $select = array('USER_ID');
        $users = \Bitrix\Main\UserGroupTable::getList(
            array(
                'filter' => $filter,
                'select' => $select,
            )
        );
        $usersCount = count($users);
        $newUsers = $usersCount - $prevUsers;
        if($lastDate === 0){
            $days = 0;
        } else {
            $days = floor(($date - $lastDate)/60 * 60 * 24);
        }

        $admins = \Bitrix\Main\UserGroupTable::getList(
            array(
                'filter' => array('GROUP_ID' => 1,'USER.ACTIVE'=>'Y'),
                'select' => array('USER_ID','USER.EMAIL'),
            )
        );
        while ($admin = $admins->Fetch()) {
            \Bitrix\Main\Mail\Event::send(array(
                "EVENT_NAME" => "REGISTERED_USERS_COUNT",
                "LID" => 's1',
                "C_FIELDS" => array(
                    "EMAIL_TO" => $admin["EMAIL"],
                    "USERS_COUNT" => $lastDate ? $newUsers : 0,
                    "DAYS_COUNT" => $days,
                ),
            )); 
        }
        return "Agents::CheckUserCount(\"".$date . "\", "."$usersCount".");";
    }
}
