<?php

namespace App\Controllers;

use App\Model\CallDetail;
use App\Model\CallHeader;
use Exception;

class CallDetailsController
{
    /**
     * return view to add a call detail
     * @param $id
     */
    public function create($id)
    {
        $callId = $id;
        $callHeader = new CallHeader();
        $data = $callHeader->where('call_id', $callId)->get();

        if (count($data) <= 0) {
            http_response_code(404);

            throw new Exception("Call Id not found");
        }

        require __DIR__ . '/../views/add_call_details.php';
    }

    /**
     * Store a call detail
     * @param array $request
     */
    public function store($request)
    {
        try {
            $callHeaderModel = new CallHeader();
            $headers = $callHeaderModel->where('call_id', $request['call_id'])->first();

            if (count($headers) <= 0) {
                http_response_code(404);

                throw new \Exception("Call Id not found");
            }

            $callHeader = $headers;
            $hours = $request['hours'];
            $minutes = $request['minutes'];

            $callDetailModel = new CallDetail();
            $callDetailModel->store($request);

            $value = $this->updateCallHeaderHoursAndMinutes($callHeader['total_hours'], $callHeader['total_minutes'], $hours, $minutes);
            $callHeaderModel->update($value, 'call_id', $request['call_id']);

            header("Location: /view-call-header?id={$request['call_id']}");
        } catch (Exception $exception) {
            http_response_code(404);
        }
    }

    /**
     * Update total hours and total minutes of call header
     * when call detail is added or removed
     *
     * @param int $totalHour
     * @param int $totalMinutes
     * @param int $newHour
     * @param int $newMinutes
     * @param boolean $addition
     * @return array
     */
    public function updateCallHeaderHoursAndMinutes($totalHour, $totalMinutes, $newHour, $newMinutes, $addition = true)
    {
        $finalHours = 0;
        $finalMinutes = 0;

        /*
        * when call detail is added
        */
        if ($addition) {
            $finalMinutes = $totalMinutes + $newMinutes;
            $carriedHours = (int)($finalMinutes / 60);

            $finalHours = $totalHour + $newHour + $carriedHours;
            $remainingMinutes = $finalMinutes % 60;

            return [
                'total_hours' => $finalHours,
                'total_minutes' => $remainingMinutes
            ];
        }

        /**
         * when call detail is removed
         */
        $finalMinutes = $newMinutes > $totalMinutes ? ($totalMinutes - $newMinutes + 60) : abs($totalMinutes - $newMinutes);
        $finalHours = $totalHour - $newHour - ($newMinutes > $totalMinutes ? 1 : 0);

        return [
            'total_hours' => $finalHours,
            'total_minutes' => $finalMinutes,
        ];
    }

    /**
     * Delete a call header
     *
     * @param  $id
     */
    public function delete($id)
    {
        try {
            $callDetailModel = new CallDetail();
            $callDetails = $callDetailModel->where('id', $id)->first();

            if (!$callDetailModel || count($callDetails) <= 0) {
                http_response_code(404);

                throw new \Exception("Call detail not found");
            }

            $callId = $callDetails['call_id'];
            $hours = $callDetails['hours'];
            $minutes = $callDetails['minutes'];
            $callDetailModel->delete('id', $id);

            $callHeaderModel = new CallHeader();
            $headers = $callHeaderModel->where('call_id', $callId)->get();
            $callHeader = $headers[0];

            $value = $this->updateCallHeaderHoursAndMinutes($callHeader['total_hours'], $callHeader['total_minutes'], $hours, $minutes, false);
            $callHeaderModel->update($value, 'call_id', $callId);
        } catch (Exception $exception) {
            http_response_code(404);
        }
    }
}
