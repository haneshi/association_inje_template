<?php

namespace Database\Seeders;

use App\Models\Travel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $seq = 1;
        $travels = [
            [
                'name' => '광화문',
                'name_eng' => 'Gwanghwamun',
                'post' => '25000',
                'address_basic' => '강원도 강릉시 바다로 123',
                'address_local' => '강문동',
                'address_detail' => '101호',
                'address_jibun' => '강원도 강릉시 강문동 123-45',
                'lat' => '37.7749',
                'lng' => '128.9194',
                'content' => '여기는 광화문입니다.',
                'is_active' => true,
            ],
            [
                'name' => '경복궁',
                'name_eng' => 'Gyeongbokgung Palace',
                'post' => '03045',
                'address_basic' => '서울특별시 종로구 사직로 161',
                'address_local' => '세종로',
                'address_detail' => '',
                'address_jibun' => '서울특별시 종로구 세종로 1-1',
                'lat' => '37.5796',
                'lng' => '126.9770',
                'content' => '조선시대 법궁으로 가장 규모가 크고 아름다운 궁궐입니다.',
                'is_active' => true,
            ],
            [
                'name' => '남산타워',
                'name_eng' => 'N Seoul Tower',
                'post' => '04340',
                'address_basic' => '서울특별시 용산구 남산공원길 105',
                'address_local' => '용산동2가',
                'address_detail' => '',
                'address_jibun' => '서울특별시 용산구 용산동2가 산1-3',
                'lat' => '37.5512',
                'lng' => '126.9882',
                'content' => '서울의 랜드마크로 야경이 아름다운 전망대입니다.',
                'is_active' => true,
            ],
            [
                'name' => '해운대 해수욕장',
                'name_eng' => 'Haeundae Beach',
                'post' => '48099',
                'address_basic' => '부산광역시 해운대구 해운대해변로 264',
                'address_local' => '중동',
                'address_detail' => '',
                'address_jibun' => '부산광역시 해운대구 중동 1411-23',
                'lat' => '35.1587',
                'lng' => '129.1604',
                'content' => '국내 최고의 해수욕장으로 여름 휴양지로 유명합니다.',
                'is_active' => true,
            ],
            [
                'name' => '제주 성산일출봉',
                'name_eng' => 'Seongsan Ilchulbong',
                'post' => '63643',
                'address_basic' => '제주특별자치도 서귀포시 성산읍 일출로 284-12',
                'address_local' => '성산리',
                'address_detail' => '',
                'address_jibun' => '제주특별자치도 서귀포시 성산읍 성산리 1',
                'lat' => '33.4584',
                'lng' => '126.9424',
                'content' => '유네스코 세계자연유산으로 일출 명소입니다.',
                'is_active' => true,
            ],
            [
                'name' => '전주 한옥마을',
                'name_eng' => 'Jeonju Hanok Village',
                'post' => '54999',
                'address_basic' => '전라북도 전주시 완산구 기린대로 99',
                'address_local' => '풍남동3가',
                'address_detail' => '',
                'address_jibun' => '전라북도 전주시 완산구 풍남동3가 123',
                'lat' => '35.8154',
                'lng' => '127.1530',
                'content' => '700여 채의 한옥이 모여있는 전통 문화 체험 명소입니다.',
                'is_active' => true,
            ],
            [
                'name' => '경주 불국사',
                'name_eng' => 'Bulguksa Temple',
                'post' => '38125',
                'address_basic' => '경상북도 경주시 불국로 385',
                'address_local' => '진현동',
                'address_detail' => '',
                'address_jibun' => '경상북도 경주시 진현동 15-1',
                'lat' => '35.7898',
                'lng' => '129.3320',
                'content' => '신라 불교 예술의 정수를 보여주는 세계문화유산입니다.',
                'is_active' => true,
            ],
            [
                'name' => '속초 설악산',
                'name_eng' => 'Seoraksan Mountain',
                'post' => '24903',
                'address_basic' => '강원특별자치도 속초시 설악산로 1091',
                'address_local' => '설악동',
                'address_detail' => '',
                'address_jibun' => '강원특별자치도 속초시 설악동 산16',
                'lat' => '38.1197',
                'lng' => '128.4655',
                'content' => '사계절 아름다운 경관을 자랑하는 국립공원입니다.',
                'is_active' => true,
            ],
            [
                'name' => '여수 오동도',
                'name_eng' => 'Odongdo Island',
                'post' => '59780',
                'address_basic' => '전라남도 여수시 오동도로 222',
                'address_local' => '수정동',
                'address_detail' => '',
                'address_jibun' => '전라남도 여수시 수정동 산1-11',
                'lat' => '34.7465',
                'lng' => '127.7671',
                'content' => '동백꽃과 해안 절경이 아름다운 섬입니다.',
                'is_active' => true,
            ],
            [
                'name' => '인천 차이나타운',
                'name_eng' => 'Incheon Chinatown',
                'post' => '22314',
                'address_basic' => '인천광역시 중구 차이나타운로 59',
                'address_local' => '선린동',
                'address_detail' => '',
                'address_jibun' => '인천광역시 중구 선린동 8-1',
                'lat' => '37.4757',
                'lng' => '126.6177',
                'content' => '한국 최대 규모의 차이나타운으로 이국적 분위기를 느낄 수 있습니다.',
                'is_active' => true,
            ],
            [
                'name' => '단양 도담삼봉',
                'name_eng' => 'Dodamsambong Peaks',
                'post' => '27003',
                'address_basic' => '충청북도 단양군 단양읍 도담삼봉로 644',
                'address_local' => '도담리',
                'address_detail' => '',
                'address_jibun' => '충청북도 단양군 단양읍 도담리 산1',
                'lat' => '36.9849',
                'lng' => '128.3651',
                'content' => '남한강 위에 솟은 세 개의 봉우리가 절경을 이루는 명승지입니다.',
                'is_active' => true,
            ],
        ];

        foreach ($travels as $travel) {
            Travel::create([
                'seq' => $travel['is_active'] ? $seq++ : 9999,
                'name' => $travel['name'],
                'name_eng' => $travel['name_eng'],
                'post' => $travel['post'],
                'address_basic' => $travel['address_basic'],
                'address_local' => $travel['address_local'],
                'address_detail' => $travel['address_detail'],
                'address_jibun' => $travel['address_jibun'],
                'lat' => $travel['lat'],
                'lng' => $travel['lng'],
                'content' => $travel['content'],
                'is_active' => $travel['is_active'],
            ]);
        }
    }
}
