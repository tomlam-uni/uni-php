<?php

namespace Uni\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AppException extends Exception
{
    protected $biz_code;
    protected $http_status;
    protected $biz_data;

    public function __construct(string $biz_code, int $http_status = 500, $biz_data = null, int $code = 0, string $message = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->biz_code = $biz_code;
        $this->http_status = $http_status;
        $this->biz_data = $biz_data;
    }

    public function render(Request $request)
    {
        $res = array(
            'biz_code' => $this->biz_code,
            'biz_message' => Lang::get('messages.' . $this->biz_code)
        );
        if (isset($this->biz_data)) {
            $res['biz_data'] = $this->biz_data;
        }
        return response()->json($res, $this->http_status);
    }

    public function getBizCode()
    {
        return $this->biz_code;
    }

    public function getHttpStatus()
    {
        return $this->http_status;
    }

    public function getBizData()
    {
        return $this->biz_data;
    }

    const APPLICATION_ALREADYEXISTS = 'APPLICATION.ALREADYEXISTS';
    const ACCOUNT_ALREADYEXISTS = 'ACCOUNT.ALREADYEXISTS';
    const DEVICE_ALREADY_EXISTS = 'DEVICE.ALREADY.EXISTS';
    const RECORD_ALREADY_EXISTS = 'RECORD.ALREADY.EXISTS';
    const PHONE_ALREADY_EXISTS = 'PHONE.ALREADY.EXISTS';
    const APPLICATION_NOTFOUND = 'APPLICATION.NOTFOUND';
    const ACCOUNT_NOTFOUND = 'ACCOUNT.NOTFOUND';
    const ACCOUNT_PROFILE_NOTFOUND = 'ACCOUNT.PROFILE.NOTFOUND';
    const ACCOUNT_PROFILE_PROVINCE_MISSING = 'ACCOUNT.PROFILE.PROVINCE.MISSING';
    const ACCOUNT_DOCUMENT_NOTFOUND = 'ACCOUNT.DOCUMENT.NOTFOUND';
    const ACCOUNT_SALARYTYPE_NOTFOUND = 'ACCOUNT.SALARYTYPE.NOTFOUND';
    const PASSWORDS_DUPLICATE = 'PASSWORDS.DUPLICATE';
    const AGREEMENT_NOTFOUND = 'AGREEMENT.NOTFOUND';
    const ACCOUNT_AGREEMENT_REPEATED = 'ACCOUNT.AGREEMENT.REPEATED';
    const ACCOUNT_AGREEMENT_DOCUMENT_NOTREADY = 'ACCOUNT.AGREEMENT.DOCUMENT.NOTREADY';
    const DISPATCH_PARCEL_NOTFOUND = 'DISPATCH.PARCEL.NOTFOUND';
    const DISPATCH_ASSIGN_FORBIDDEN = 'DISPATCH.ASSIGN.FORBIDDEN';
    const SCAN_BATCH_NOTFOUND = 'SCAN.BATCH.NOTFOUND';
    const SCAN_BATCH_CLOSED = 'SCAN.BATCH.CLOSED';
    const SCAN_BATCH_CONFIRMED = 'SCAN.BATCH.CONFIRMED';
    const SCAN_BATCH_CONFIRM_FORBIDDEN = 'SCAN.BATCH.CONFIRM.FORBIDDEN';
    const SCAN_WRONG_PARCEL = 'SCAN.WRONG.PARCEL';
    const SCAN_ALREADY_SCANNED = 'SCAN.ALREADY.SCANNED';
    const DELIVERY_PARCEL_NOTFOUND = 'DELIVERY.PARCEL.NOTFOUND';
    const DELIVERY_FORBIDDEN = 'DELIVERY.FORBIDDEN';
    const DELIVERY_RETRY_FORBIDDEN = 'DELIVERY.RETRY.FORBIDDEN';
    const DELIVERY_REOPEN_FORBIDDEN = 'DELIVERY.REOPEN.FORBIDDEN';
    const DELIVERY_REOPEN_FAILED = 'DELIVERY.REOPEN.FAILED';
    const DELIVERY_PARCEL_DETAINED = 'DELIVERY.PARCEL.DETAINED';
    const SMS_TEMPLATE_NOTFOUND = 'SMS.TEMPLATE.NOTFOUND';
    const WAREHOUSE_NOTFOUND = 'WAREHOUSE.NOTFOUND';
    const DROPOFF_SERVICEPOINT_NOTFOUND = 'DROPOFF.SERVICEPOINT.NOTFOUND';
    const DROPOFF_PARCEL_NOTFOUND = 'DROPOFF.PARCEL.NOTFOUND';
    const MASTERDATA_REGION_INVALID = 'MASTERDATA.REGION.INVALID';
    const VERIFICATION_FAILED = 'VERIFICATION.FAILED';
    const VERIFICATION_EXPIRED = 'VERIFICATION.EXPIRED';
    const VALIDATION_PHONE_INVALID = 'VALIDATION.PHONE.INVALID';
    const VALIDATION_PASSWORD_INVALID = 'VALIDATION.PASSWORD.INVALID';
    const VALIDATION_VERICODE_INVALID = 'VALIDATION.VERICODE.INVALID';
    const UPLOAD_FILE_INVALID = 'UPLOAD.FILE.INVALID';
    const UPLOAD_FILE_UNSUPPORTEDFORMAT = 'UPLOAD.FILE.UNSUPPORTEDFORMAT';
    const UPLOAD_FILE_EXCEEDSIZELIMIT = 'UPLOAD.FILE.EXCEEDSIZELIMIT';
    const LOGIN_FAILED = 'LOGIN.FAILED';
    const COMMON_INPUT_ILLEGAL = 'COMMON.INPUT.ILLEGAL';
    const COMMON_MODEL_UNKNOWNSUB = 'COMMON.MODEL.UNKNOWNSUB';
    const COMMON_WRITE_FORBIDDEN = 'COMMON.WRITE.FORBIDDEN';
    const COMMON_QUERY_NOTFOUND = 'COMMON.QUERY.NOTFOUND';
    const COMMON_QUERY_UNKNOWNCRITERIA = 'COMMON.QUERY.UNKNOWNCRITERIA';
    const INVOCATION_INCOMPLETE = 'INVOCATION.INCOMPLETE';
    const ROUTE_PLAN_FORBIDDEN = 'ROUTE.PLAN.FORBIDDEN';
}
