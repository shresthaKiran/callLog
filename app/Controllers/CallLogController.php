<?php

namespace App\Controllers;

use App\Model\CallDetail;
use App\Model\CallHeader;
use App\Model\Model;
use DateTime;
use Exception;

class CallLogController extends Model
{
    /**
     * Return view to list all the call headers.
     */
    public function index()
    {
        $callHeaders = $this->getCallHeaders();

        require __DIR__ . '/../views/index.php';
    }

    /**
     * Return view to add a call header
     */
    public function createCallHeader()
    {
        require __DIR__ . '/../views/add_call_header.php';
    }

    /**
     * Store a call header
     *
     * @param array $request
     */
    public function storeCallHeader($request)
    {
        try {
            $request['call_id'] = $this->generateCallId();
            $request['total_hours'] = 0;
            $request['total_minutes'] = 0;

            $callHeader = new CallHeader();
            $callHeader->store($request);

            return header("Location: /view-call-header?id={$request['call_id']}");
        } catch (Exception $exception) {
            http_response_code(404);
        }
    }

    /**
     * Update call header
     *
     * @param array $request
     */
    public function updateCallHeader($request)
    {
        try {
            $callId = $request['call_id'];
            unset($request['call_id']);
            unset($request['total_hours']);
            unset($request['total_minutes']);
            print_r($request);

            $callHeader = new CallHeader();
            $callHeader->update($request, 'call_id', $callId);

            return header("Location: /view-call-header?id={$callId}");
        } catch (Exception $exception) {
            http_response_code(404);
        }
    }

    /**
     * Delete a call header
     *
     * @param array $request
     */
    public function deleteCallHeader($request)
    {
        try {
            $callId = $request['call_id'];

            $callHeader = new CallHeader();

            $data = $callHeader->where('call_id', $callId)->get();

            if (count($data) <= 0) {
                http_response_code(404);

                throw new Exception("Call Id not found");
            }

            $callDetailModel = new CallDetail();
            $callDetailModel->delete('call_id', $callId);


            $callHeader->delete('call_id', $callId);

            http_response_code(200);
        } catch (Exception $exception) {
            http_response_code(404);
        }
    }

    /**
     * Return all the call headers
     */
    public function getCallHeaders()
    {
        $callHeader = new CallHeader();
        return $callHeader->all();
    }

    /**
     * Generate no gap call id
     *
     * @return void
     */
    public function generateCallId()
    {
        $callHeader = new CallHeader();
        $callIds = $callHeader->select(['call_id'])->orderBy('call_id')->get();
        $breakPoint = null;

        if (count($callIds) <= 0) {
            return 1;
        }

        foreach ($callIds as $index => $callId) {
            if (($index + 1) !== $callId['call_id']) {
                $breakPoint = $index + 1;
                break;
            } else {
                $breakPoint = $index + 2;
            }
        }

        return $breakPoint;
    }

    /**
     * Return view to display details of call header
     *
     * @param $id
     */
    public function viewCallHeader($id)
    {
        $callHeader = new CallHeader();
        $headers = $callHeader->where('call_id', $id)->first();

        if (count($headers) <= 0) {
            http_response_code(404);

            throw new \Exception("Call Id not found");
        }

        $data = $headers;

        $callDetailModel = new CallDetail();
        $callDetails = $callDetailModel->where('call_id', $id)->get();

        require __DIR__ . '/../views/call_header_details.php';
    }

    /**
     * Search queryString in call_id, date and username field
     *
     * @param array $request
     */
    public function search($request)
    {
        try {
            if (isset($request['query']) && $request['query']) {
                $callHeaderModel = new CallHeader();
                $callHeaders = $callHeaderModel->where('username', $request['query'], 'like');

                if ($this->validateDate($request['query'], 'Y-m-d')) {
                    $callHeaders = $callHeaders->orWhereDate('date', $request['query']);
                }

                $callHeaders = $callHeaders->orWhere('call_id', $request['query'])
                    ->get();
            } else {
                $callHeaders = $this->getCallHeaders();
            }

            require __DIR__ . '/../views/index.php';
        } catch (Exception $exception) {
            http_response_code(404);
        }
    }

    /**
     * Check if the date is valid
     *
     * @param string $date
     * @param string $format
     * @return boolean
     */
    public function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
