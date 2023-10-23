<?php

namespace Uni\MasterData\Contracts\impl;

use Uni\MasterData\Contracts\MDMQueryService;
use Uni\MasterData\Models\Address;
use Uni\MasterData\Models\MessageTemplate;
use Uni\MasterData\Models\Region;
use Uni\MasterData\Repositories\AddressRepository;
use Uni\MasterData\Repositories\AgreementRepository;
use Uni\MasterData\Repositories\DictionaryRepository;
use Uni\MasterData\Repositories\MessageTemplateRepository;
use Uni\MasterData\Repositories\RegionRepository;
use Uni\MasterData\Repositories\VersionRepository;
use Uni\Exceptions\AppException;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Log;

class DefaultMDMQueryService implements MDMQueryService
{
    protected $regionRepository;
    protected $dictionaryRepository;
    protected $agreementRepository;
    protected $messageTemplateRepository;
    protected $versionRepository;
    protected $addressRepository;

    public function __construct()
    {
        $container = Container::getInstance();
        $this->regionRepository = $container->make(RegionRepository::class);
        $this->dictionaryRepository = $container->make(DictionaryRepository::class);
        $this->agreementRepository = $container->make(AgreementRepository::class);
        $this->messageTemplateRepository = $container->make(MessageTemplateRepository::class);
        $this->versionRepository = $container->make(VersionRepository::class);
        $this->addressRepository = $container->make(AddressRepository::class);
    }

    public function getRegionById($id)
    {
        try {
            $region = $this->regionRepository->findById($id);
            if ($region == null)
                return null;
            else
                return $region->toArray();
        } catch (\Exception $e) {
            Log::error('Query region failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getRegionByCode($code, $level)
    {
        try {
            $region = $this->regionRepository->findRegionByCode($code, $level);
            if ($region == null)
                return null;
            else
                return $region->toArray();
        } catch (\Exception $e) {
            Log::error('Query region failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getCountries()
    {
        try {
            return $this->regionRepository->findByLevel(Region::LEVEL_COUNTRY)->toArray();
        } catch (\Exception $e) {
            Log::error('Query countries failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getProvincesByCountryCode($country_code)
    {
        try {
            return $this->regionRepository->findByParent($country_code, Region::LEVEL_PROVINCE)->toArray();
        } catch (\App\Exceptions\AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query provinces failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getCitiesByProvinceCode($province_code)
    {
        try {
            return $this->regionRepository->findByParent($province_code, Region::LEVEL_CITY)->toArray();
        } catch (\App\Exceptions\AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query cities failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getDeliveryAreasByProvinceCode($province_code)
    {
        try {
            return $this->regionRepository->findDeliveryAreasByRegion($province_code)->toArray();
        } catch (\App\Exceptions\AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query delivery areas failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getWarehousesByProvinceCode($province_code)
    {
        try {
            return $this->regionRepository->findWarehousesByProvinceCode($province_code)->toArray();
        } catch (\App\Exceptions\AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query warehouses failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getDeliveryAreasByWarehouseId($warehouse_id)
    {
        try {
            return $this->regionRepository->findDeliveryAreasByWarehouse($warehouse_id)->toArray();
        } catch (\App\Exceptions\AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query delivery areas failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getDeliveryAreaById($id)
    {
        try {
            $delivery_area = $this->regionRepository->findDeliveryAreaById($id);
            if ($delivery_area == null)
                return null;
            else
                return $delivery_area->toArray();
        } catch (\Exception $e) {
            Log::error('Query delivery area failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getVehicleTypes()
    {
        try {
            return $this->dictionaryRepository->findDictItemsByType('VEHICLE.TYPE')->toArray();
        } catch (\Exception $e) {
            Log::error('Query vehicle types failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getAgreementById($id)
    {
        try {
            $agreement = $this->agreementRepository->findById($id);
            if ($agreement == null)
                return null;
            else
                return $agreement->toArray();
        } catch (\Exception $e) {
            Log::error('Query agreement failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getAgreementsForDriver($province)
    {
        try {
            return $this->agreementRepository->findByTarget($province, 1)->toArray();
        } catch (\Exception $e) {
            Log::error('Query agreements failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getDictionary($type)
    {
        try {
            return $this->dictionaryRepository->findDictItemsByType($type)->toArray();
        } catch (\Exception $e) {
            Log::error('Query dictionary failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getMessageTemplateById($id)
    {
        try {
            if (!$template = $this->messageTemplateRepository->findById($id))
                throw new AppException(AppException::SMS_TEMPLATE_NOTFOUND, 404);
            return $template->toArray();
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query message template failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getMessageTemplatesByWarehouseId($warehouse_id)
    {
        try {
            return $this->messageTemplateRepository->findByWarehouseId($warehouse_id)->toArray();
        } catch (\Exception $e) {
            Log::error('Query message templates failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getDefaultMessageTemplates()
    {
        try {
            return $this->messageTemplateRepository->findByWarehouseId(MessageTemplate::DEFAULT_WAREHOUSE)->toArray();
        } catch (\Exception $e) {
            Log::error('Query message templates failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getMessageTemplatesByConditions($warehouse_id, $language)
    {
        try {
            return $this->messageTemplateRepository->findByConditions($warehouse_id, $language)->toArray();
        } catch (\Exception $e) {
            Log::error('Query message templates failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getDefaultMessageTemplatesByLanguage($language)
    {
        try {
            return $this->messageTemplateRepository->findByConditions(MessageTemplate::DEFAULT_WAREHOUSE, $language)->toArray() ?: $this->messageTemplateRepository->findByConditions(MessageTemplate::DEFAULT_WAREHOUSE, MessageTemplate::DEFAULT_LANGUAGE)->toArray();
        } catch (\Exception $e) {
            Log::error('Query message templates failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getWarehouseById($id)
    {
        try {
            if (!$warehouse = $this->regionRepository->findWarehouseById($id)) {
                throw new AppException(AppException::WAREHOUSE_NOTFOUND, 404);
            }
            return $warehouse->toArray();
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query warehouse failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getLatestVersionByConditions($product_type, $os_type, $region)
    {
        try {
            if (!$version = $this->versionRepository->findLatestVersionByConditions($product_type, $os_type, $region)) {
                throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
            }
            return $version->toArray();
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query latest version failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function getTopOneAccessCodesByOrderId($order_id)
    {
        try {
            if (!$result = $this->addressRepository->findByOrderId($order_id, Address::AGGREGATE_SUB_ACCESS_CODE)->getAccessCodes()[0]) {
                throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
            };

            return $result[0];
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Query address access codes failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function createAddressAccessCode($driver_id, $order_id, $access_code, $comment)
    {
        try {
            $address = $this->addressRepository->findByOrderId($order_id, Address::AGGREGATE_ROOT);

            $address->createAccessCode($driver_id, $access_code, $comment);

            $this->addressRepository->store($address, Address::AGGREGATE_SUB_ACCESS_CODE);
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Create address access code failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }

    public function rankAccessCode($id)
    {
        try {
            if (!$address = $this->addressRepository->findByAccessCodeId($id)) {
                throw new AppException(AppException::COMMON_QUERY_NOTFOUND, 404);
            }

            $address->getAccessCodes()[0]->rank();

            $this->addressRepository->store($address, Address::AGGREGATE_SUB_ACCESS_CODE);
        } catch (AppException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Update address access code failed, Caused by: ' . $e->getMessage());
            throw new \Exception('System exception occurred.');
        }
    }
}
