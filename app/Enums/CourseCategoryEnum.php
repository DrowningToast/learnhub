<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum CourseCategoryEnum: string
{
    use InteractWithEnum;

    case HEALTH_WELLNESS = '1';     // สุขภาพและการดูแลตนเอง
    case DIGITAL_LITERACY = '2';    // ทักษะการใช้เทคโนโลยีพื้นฐาน
    case FINANCIAL_LITERACY = '3';  // การจัดการทางการเงิน
    case HOBBIES_CRAFTS = '4';      // งานอดิเรกและงานฝีมือ
    case SOCIAL_CONNECTIONS = '5';  // การสร้างความสัมพันธ์ทางสังคม
    case MENTAL_WELLBEING = '6';    // สุขภาพจิตและความเป็นอยู่ที่ดี
    case NUTRITION = '7';           // โภชนาการและการกินที่ถูกต้อง
}
