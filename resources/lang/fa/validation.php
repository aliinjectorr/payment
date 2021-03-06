<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    "accepted"         => ":attribute باید پذیرفته شده باشد.",
    "active_url"       => " :attribute وارد شده فعال نیست",
    "after"            => ":attribute باید تاریخی بعد از :date باشد.",
    "alpha"            => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash"       => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num"        => ":attribute باید شامل حروف الفبا و عدد باشد.",
    "array"            => ":attribute باید شامل آرایه باشد.",
    "before"           => ":attribute باید تاریخی قبل از :date باشد.",
    "between"          => array(
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file"    => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string"  => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array"   => ":attribute باید بین :min و :max آیتم باشد.",
    ),
    "boolean"          => "The :attribute field must be true or false",
    "confirmed"        => ":attribute با تاییدیه مطابقت ندارد.",
    "date"             => ":attribute یک تاریخ معتبر نیست.",
    "date_format"      => ":attribute با الگوی :format مطاقبت ندارد.",
    "different"        => ":attribute و :other باید متفاوت باشند.",
    "digits"           => ":attribute باید :digits رقم باشد.",
    "digits_between"   => ":attribute باید بین :min و :max رقم باشد.",
    "email"            => "فرمت :attribute معتبر نیست.",
    "exists"           => ":attribute انتخاب شده، معتبر نیست.",
    "image"            => ":attribute باید تصویر باشد.",
    "in"               => ":attribute انتخاب شده، معتبر نیست.",
    "integer"          => ":attribute باید نوع داده ای عددی (integer) باشد.",
    "ip"               => ":attribute باید IP آدرس معتبر باشد.",
    "max"              => array(
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file"    => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string"  => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array"   => ":attribute نباید بیشتر از :max آیتم باشد.",
    ),
'gt'=> [
    'numeric' => ':attribute باید بزرگتر باشد.',
    'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
    'string'  => 'The :attribute must be greater than or equal :value characters.',
    'array'   => 'The :attribute must have :value items or more.',
],
'lt'=> [
    'numeric' => ':attribute باید کوچکتر از :value باشد.',
    'file'    => 'The :attribute must be greater than or equal :value kilobytes.',
    'string'  => 'The :attribute must be greater than or equal :value characters.',
    'array'   => 'The :attribute must have :value items or more.',
],
    "mimes"            => ":attribute باید یکی از فرمت های :values باشد.",
    "dimensions"            => "ابعاد :attribute مناسبت نیست",
    "min"              => array(
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file"    => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string"  => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array"   => ":attribute نباید کمتر از :min آیتم باشد.",
    ),
    "not_in"           => ":attribute انتخاب شده، معتبر نیست.",
    "numeric"          => ":attribute باید شامل عدد باشد.",
    "regex"            => ":attribute یک فرمت معتبر نیست",
    "required"         => "فیلد :attribute الزامی است",
    "required_unless"    => ":attribute الزامی است زمانی که :other فعال نباشد.",
    "required_if"      => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_with"    => ":attribute الزامی است زمانی که :values موجود است.",
    "required_with_all"=> ":attribute الزامی است زمانی که :values موجود است.",
    "required_without" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است زمانی که :values موجود نیست.",
    "same"             => ":attribute و :other باید مانند هم باشند.",
    "size"             => array(
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file"    => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string"  => ":attribute باید برابر با :size کاراکتر باشد.",
        "array"   => ":attribute باسد شامل :size آیتم باشد.",
    ),
    "timezone"         => "The :attribute must be a valid zone.",
    "unique"           => ":attribute قبلا انتخاب شده است.",
    "url"              => "فرمت آدرس :attribute اشتباه است.",
    "exists_code"      => "کد ارسالی در سیستم وجود ندارد",
    "expire_code"      => "اعتبار کد ارسالی به پایان رسیده است",
    "used"             => "این کد قبلا مورد استفاده قرار گرفته است",
    "exists_phone"     => "چنین شماره ای در سیستم ثبت نشده است",
    'recaptcha' => ' :attribute اشتباه است',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'custom' => [
        'recaptcha' => ':attribute را وارد نمایید.',
        'g-recaptcha-response' => [
            'required' => 'لطفا کپچا را کلیک کنید',
            'captcha' => 'لطفا کپچا را وارد کنید',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(
        "name" => "نام",
        "username" => "نام کاربری",
        "email" => "پست الکترونیکی",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "password" => "رمز عبور",
        "password_confirmation" => "تاییدیه ی رمز عبور",
        "city" => "شهر",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "body" => "متن",
        "imageUrl" => "تصویر",
        "videoUrl" => "آدرس ویدیو",
        "slug" => "نامک",
        "tags" => "تگ ها",
        "category" => "دسته",
        "story" => "داستان",
        'number' => 'شماره ',
        'price' => 'قیمت ',
        'course_id' => 'دوره مورد نظر',
        'fileUrl' => 'آدرس فایل',
        'enSlug' => 'نامک انگلیسی',
        'percent' => 'درصد',
        'images' => 'تصویر',
        'published_at' => 'زمان انتشار',
        'category_id' => 'دسته بندی',
        'comment' => 'نظر',
        'phoneNumber' => 'شماره موبایل',
        'family' => 'نام خانوادگی',
        'firstName' => 'نام',
        'lastName' => 'نام خانوادگی',
        'fatherName' => 'نام پدر',
        'tel' => 'تلفن',
        'nationalCode' => 'کد ملی',
        'shenasnamehCode' => 'شماره شناسنامه',
        'placeOfIssue' => 'محل سکونت',
        'birthDate' => 'تاریخ تولد',
        'zipCode' => 'کد پستی',
        'shenasnamehPic' => 'تصویر شناسنامه',
        'melliCardPic' => 'تصویر کارت ملی',
        'scope' => 'حوزه',
        'bank' => 'بانک',
        'shop_email' => 'ایمیل فروشگاه',
        'province' => 'استان',
        'icon' => 'آیکون',
        'logo' => 'لوگو',
        'amount' => 'موجودی',
        'image' => 'تصویر',
        'attachment' => 'فایل',
        'file_size  ' => 'حجم',
        'card_id  ' => 'شماره کارت',
        'english_name' => 'نام لاتین فروشگاه',
        'telegram_url' => 'لینک تلگرام',
        'instagram_url' => 'لینک اینستاگرام',
        'facebook_url' => 'لینک فیسبوک',
        'new_address' => 'آدرس جدید',
        'new-password' => 'رمز عبور جدید',
        'productCat_id' => 'دسته بندی محصول',
        'feedback' => 'بازخورد',
        'zip_code' => 'کد پستی',
        'shipping_way' => 'روش ارسال',
        'discount_amount' => 'میزان تخفیف',
        'question' => 'سوال',
        'answer' => 'پاسخ',
        'sign' => 'محل امضا',
        'custom_info' => 'اطلاعات خریدار',
        'seller_info' => 'اطلاعات فروشنده',
        'economic_code' => 'کد اقتصادی',
        'registration_number' => 'شماره ثبت',
        'vat' => 'مالیات',
        'description_status' => 'توضیحات',
        'economic_code_number' => 'کد اقتصادی',
        'registration_number‌_number' => 'شماره ثبت',
        'motto_text' => 'متن شعار',
        'starts_at' => 'تاریخ شروع',
        'expires_at' => 'تاریخ انقضا',
        'off_price' => 'قیمت بعد از تخفیف',
        'min_amount' => 'حداقل موجودی',
        'measure' => 'واحد شمارش',
        'weight' => 'وزن',
        'quick_way_price' => 'مبلغ ارسال سریع',
        'posting_way_price' => 'مبلغ ارسال پستی',
        'person_way_price' => 'مبلغ دریافت حضوری',
        'online_payment' => 'پرداخت آنلاین',
        'cash_payment' => 'پرداخت نقدی',
        'menu_show' => 'نمایش دسته بندی های سایت',
        'menu_show_count' => 'تعداد دسته بندی های منو',
        'cat_image_status' => 'نمایش آیکون دسته بندی ها',
        'VAT' => 'محاسبه درصد مالیات بر ارزش افزوده',
        'watermark_status' => 'واترمارک روی تصویر محصولات',
        'buyCount_show' => 'نمایش تعداد فروش های هر محصول به کاربران',
        'special_offer' => 'نمایش پیغام پیشنهاد ویژه در بالای تمامی صفحات',
        'watermark' => 'تصویر واترمارک',
        'special_offer_text' => 'متن پیغام پیشنهاد ویژه',
        'off_price_started_at' => 'تاریخ شروع تخفیف',
        'off_price_expired_at' => 'تاریخ اتمام تخفیف',
        'code' => 'کد تخفیف',
        'uses' => 'تعداد قابل استفاده',
        'payment_method' => 'روش پرداخت',
        'new_password' => 'رمز عبور جدید',
        'old_password' => 'رمز عبور قدیم',
        'g-recaptcha-response' => 'کد امنیتی',
        'parent_id' => 'کد ریشه اصلی',
        'url' => 'لینک',
        'queryy' => 'جستجو',
        'facility.*' => 'امکانات ویژه محصول',
        'value.*' => 'ویژگی های دسته بندی',
        'color.*' => 'رنگ',
        'specifications.*' => 'خصوصیت',
        'color_amount_number.*' => 'موجودی رنگ',
        'specification_amount_number.*' => 'موجودی خصوصیت',
        'specification_amount' => 'محاسبه موجودی بر اساس خصوصیت',
        'on' => 'فعال',
        'color_amount' => 'موجودی رنگ',

          ),
);
