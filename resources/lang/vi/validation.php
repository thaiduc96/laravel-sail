<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'active_url' => 'Trường :attribute không phải là một URL hợp lệ.',
    'after' => 'Trường :attribute phải là một ngày sau ngày :date.',
    'after_or_equal' => 'Trường :attribute phải là thời gian bắt đầu sau hoặc đúng bằng :date.',
    'alpha' => 'Trường :attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ có thể chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num' => 'Trường :attribute chỉ có thể chứa chữ cái và số.',
    'array' => 'Trường :attribute phải là dạng mảng.',
    'before' => 'Trường :attribute phải là một ngày trước ngày :date.',
    'before_or_equal' => 'Trường :attribute phải là thời gian bắt đầu trước hoặc đúng bằng :date.',
    'between' => [
        'numeric' => 'Trường :attribute phải nằm trong khoảng :min - :max.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải từ :min - :max kB.',
        'string' => 'Trường :attribute phải từ :min - :max ký tự.',
        'array' => 'Trường :attribute phải có từ :min - :max phần tử.',
    ],
    'boolean' => 'Trường :attribute phải là true hoặc false.',
    'confirmed' => 'Giá trị xác nhận trong trường :attribute không khớp.',
    'date' => 'Trường :attribute không phải là định dạng của ngày-tháng.',
    'date_equals' => 'Trường :attribute phải là một ngày bằng với :date.',
    'date_format' => 'Trường :attribute không giống với định dạng :format.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Độ dài của trường :attribute phải gồm :digits chữ số.',
    'digits_between' => 'Độ dài của trường :attribute phải nằm trong khoảng :min and :max chữ số.',
    'dimensions' => 'Trường :attribute có kích thước không hợp lệ.',
    'distinct' => 'Trường :attribute có giá trị trùng lặp.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong những giá trị sau: :values',
    'exists' => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'file' => 'Trường :attribute phải là một tệp tin.',
    'filled' => 'Trường :attribute không được bỏ trống.',
    'gt' => [
        'numeric' => 'Giá trị trường :attribute phải lớn hơn :value.',
        'file' => 'Dung lượng trường :attribute phải lớn hơn :value kilobytes.',
        'string' => 'Độ dài trường :attribute phải nhiều hơn :value kí tự.',
        'array' => 'Mảng :attribute phải có nhiều hơn :value phần tử.',
    ],
    'gte' => [
        'numeric' => 'Giá trị trường :attribute phải lớn hơn hoặc bằng :value.',
        'file' => 'Dung lượng trường :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'string' => 'Độ dài trường :attribute phải lớn hơn hoặc bằng :value kí tự.',
        'array' => 'Mảng :attribute phải có ít nhất :value phần tử.',
    ],
    'image' => 'Trường :attribute phải là định dạng hình ảnh.',
    'in' => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'in_array' => 'Trường :attribute phải thuộc tập cho phép: :other.',
    'integer' => 'Trường :attribute phải là một số nguyên.',
    'ip' => 'Trường :attribute phải là một địa chỉ IP.',
    'ipv4' => 'Trường :attribute phải là một địa chỉ IPv4.',
    'ipv6' => 'Trường :attribute phải là một địa chỉ IPv6.',
    'json' => 'Trường :attribute phải là một chuỗi JSON.',
    'lt' => [
        'numeric' => 'Giá trị trường :attribute phải nhỏ hơn :value.',
        'file' => 'Dung lượng trường :attribute phải nhỏ hơn :value kilobytes.',
        'string' => 'Độ dài trường :attribute phải nhỏ hơn :value kí tự.',
        'array' => 'Mảng :attribute phải có ít hơn :value phần tử.',
    ],
    'lte' => [
        'numeric' => 'Giá trị trường :attribute phải nhỏ hơn hoặc bằng :value.',
        'file' => 'Dung lượng trường :attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'string' => 'Độ dài trường :attribute phải nhỏ hơn hoặc bằng :value kí tự.',
        'array' => 'Mảng :attribute không được có nhiều hơn :value phần tử.',
    ],
    'max' => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file' => 'Dung lượng tập tin trong trường :attribute không được lớn hơn :max kB.',
        'string' => 'Trường :attribute không được lớn hơn :max ký tự.',
        'array' => 'Trường :attribute không được lớn hơn :max phần tử.',
    ],
    'mimes' => 'Trường :attribute phải là một tập tin có định dạng: :values.',
    'mimetypes' => 'Trường :attribute phải là một tập tin có định dạng: :values.',
    'min' => [
        'numeric' => 'Trường :attribute phải tối thiểu là :min.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải tối thiểu :min kB.',
        'string' => 'Trường :attribute phải có tối thiểu :min ký tự.',
        'array' => 'Trường :attribute phải có tối thiểu :min phần tử.',
    ],
    'not_in' => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'not_regex' => 'Trường :attribute có định dạng không hợp lệ.',
    'numeric' => 'Trường :attribute phải là một số.',
    'password' => 'Mật khẩu không đúng.',
    'present' => 'Trường :attribute phải được cung cấp.',
    'regex' => 'Trường :attribute có định dạng không hợp lệ.',
    'required' => 'Trường :attribute không được bỏ trống.',
    'required_if' => 'Trường :attribute không được bỏ trống khi trường :other là :value.',
    'required_unless' => 'Trường :attribute không được bỏ trống trừ khi :other là :values.',
    'required_with' => 'Trường :attribute không được bỏ trống khi một trong :values có giá trị.',
    'required_with_all' => 'Trường :attribute không được bỏ trống khi tất cả :values có giá trị.',
    'required_without' => 'Trường :attribute không được bỏ trống khi một trong :values không có giá trị.',
    'required_without_all' => 'Trường :attribute không được bỏ trống khi tất cả :values không có giá trị.',
    'same' => 'Trường :attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => 'Trường :attribute phải bằng :size.',
        'file' => 'Dung lượng tập tin trong trường :attribute phải bằng :size kB.',
        'string' => 'Trường :attribute phải chứa :size ký tự.',
        'array' => 'Trường :attribute phải chứa :size phần tử.',
    ],
    'starts_with' => 'Trường :attribute phải được bắt đầu bằng một trong những giá trị sau: :values',
    'string' => 'Trường :attribute phải là một chuỗi ký tự.',
    'timezone' => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique' => 'Trường :attribute đã có trong cơ sở dữ liệu.',
    'uploaded' => 'Trường :attribute tải lên thất bại.',
    'url' => 'Trường :attribute không giống với định dạng một URL.',
    'uuid' => 'Trường :attribute phải là một chuỗi UUID hợp lệ.',

    'phone_invalid' => 'Số điện thoại không hợp lệ',
    'phone_invalid_index' => 'Số điện thoại :phone không hợp lệ',
    'data_invalid' =>  ':attribute không hợp lệ',
    'change_data' => ':field được sửa từ :from thành :to',
    'change_data_sub_item' => ':code : :field được sửa từ :from thành :to',
    'delete_data_sub_item' => 'Đã xóa :code ',
    'print_history' => 'In phiếu trả :quantity sản phẩm cho ca bảo hành :code',
    'create_request_guarantee' => 'Tạo yêu cầu duyệt cho ca bảo hành :code . :reason_request : :reason_text',
    'update_request_guarantee_status' => 'Cập nhật trạng thái yêu cầu duyệt cho ca bảo hành :code . Từ :from thành :to',
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

    'wrong_old_pw' => 'Mật khẩu cũ không đúng',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'all' => 'Tất cả',
        'north' => 'Miền Bắc',
        'south' => 'Miền Nam'
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

    'attributes' => [
        'name' => 'tên',
        'username' => 'tên đăng nhập',
        'email' => 'email',
        'first_name' => 'tên',
        'last_name' => 'họ',
        'password' => 'mật khẩu',
        'password_confirmation' => 'xác nhận mật khẩu',
        'city' => 'thành phố',
        'country' => 'quốc gia',
        'address' => 'địa chỉ',
        'phone' => 'số điện thoại',
        'mobile' => 'di động',
        'age' => 'tuổi',
        'sex' => 'giới tính',
        'gender' => 'giới tính',
        'year' => 'năm',
        'month' => 'tháng',
        'day' => 'ngày',
        'hour' => 'giờ',
        'minute' => 'phút',
        'second' => 'giây',
        'title' => 'tiêu đề',
        'content' => 'nội dung',
        'body' => 'nội dung',
        'description' => 'mô tả',
        'excerpt' => 'trích dẫn',
        'date' => 'ngày',
        'time' => 'thời gian',
        'subject' => 'tiêu đề',
        'message' => 'lời nhắn',
        'available' => 'có sẵn',
        'size' => 'kích thước',
        'desires_id' => 'mong muốn',
        'skin_color_id' => 'màu da',
        'job_id' => 'công việc',
        'marital_status_id' => 'trạng thái hôn nhân',
        'full_name' => 'tên đầy đủ',
        'hobby' => 'sở thích',
        'date_of_birth' => 'ngày sinh',
        'province_id' => 'quê quán',
        'height' => 'chiều cao',
        'weight' => 'cân nặng',
        'lat' => 'kinh độ',
        'latitude' => 'kinh độ',
        'longitude' => 'vĩ độ',
        'lng' => 'vĩ độ',
        'is_online' => 'trạng thái online',
        'photo' => 'ảnh',
        'district_id' => 'quận/huyện',
        'ward_id' => 'phường/xã/thị trấn',
        'shop_id' => 'cửa hàng',
        'payment' => 'thanh toán',
        'desired_times' => 'khoảng thời gian mong muốn',
        'from_num_of_friends' => 'số người đi cùng',
        'appointment_id' => 'cuộc hẹn',
        'member_id' => 'thành viên',
        'member' => 'thành viên',
        'notification' => 'thông báo',
        'appointment_status_id' => 'trạng thái cuộc hẹn',
        'reason' => 'lí do',
        'minutes' => 'phút',
        'prices.hour' => 'giá theo giờ',
        'prices.day' => 'giá theo ngày',
        'image' => 'ảnh',
        'prices.month' => 'giá theo tháng',
        'years_experiences' => 'số năm kinh nghiệm',
        'pick_up_point' => 'điểm đón',
        'driver_id' => 'tài xế',
        'place_id' => 'tỉnh / tp',
        "phone_number" => "số điện thoại",
        "vehicle_type" => "phương tiện",
        "referral_code" => "mã giới thiệu",

        'services' => 'Dịch vụ',
        'short_note' => 'Mô tả ngắn',
        'file' => 'Tập tin',
        "note" => 'Mô tả chi tiết',

        'doctor_id' => 'ID bác sĩ',
        'diagnose' => 'Chuẩn đoán',
        'date_of_re_examination' => 'Ngày tái khám',
        're_examination_place' => 'Nơi tái khám',
        'advice' => 'Lời khuyên',
        'total_day_use_medicine' => 'Tổng số ngày sử dụng thuốc',
        'total_drug' => 'Tổng lượng thuốc',
        'medicine_id' => 'ID thuốc',
        'unit' => 'Đơn vị',

        'user_name' => 'Họ tên',
        'password_confirm' => 'Nhập lại mật khẩu',
        'customer' => 'Khách hàng',
        'user_id' => 'ID người dùng',
        'sms_otp' => 'Mã SMS OTP',
        'day_of_birth' => 'Ngày sinh',
        'city_id' => 'ID Thành phố',
        'village_id' => 'ID Phường/Xã',
        'avatar' => 'Ảnh đại diện',
        'user' => 'Nhân viên',
        'account_type_facebook' => 'Facebook',
        'account_type_google' => 'Google',

        'cancel' => 'Huỷ',
        'pending' => 'Đang thực hiện',
        'complete' => 'Hoàn thành',

        'product' => 'Sản phẩm',
        'spare_part' => 'Linh kiện',
        'quantity' => 'Số lượng',
        'purpose_id' => 'Mục đích',
        'from_branch_id' => 'Điểm đầu',
        'to_branch_id' => 'Điểm cuối',
        'gift_id' => 'Linh kiện',
        'branch_id' => 'Trạm/TT bảo hành',
        'status' => 'Trạng thái',
        'admin_group_id' => 'Nhóm nhân viên',
        'percent_discount' => 'Phần trăm giảm giá',
        'warehouse_id' => 'Kho',
        'admin_id' => 'Nhân viên',
        'type' => 'Loại',
        'group_secondary_ids' => 'Nhóm phụ',
        'group_secondary_id' => 'Nhóm phụ',
        'distributor_guarantee_period' => 'Thời gian bảo hành nhà phân phối',
        'retail_guarantee_period' => 'Thời gian bảo hành khách lẻ',
        'distributor_renovation_period' => 'Thời gian đổi mới nhà phân phối',
        'distributor_region' => 'Khu vực đổi mới nhà phân phối',
        'retail_renovation_period' => 'Thời gian đổi mới khách lẻ',
        'retail_region' => 'Khu vực đổi mới khách lẻ',
        'renovation_period_from_buy_date' => 'Thời gian đổi mới kể từ ngày mua',
        'buy_date_region' => 'Khu vực đổi mới kể từ ngày mua',
        'content_alert' => 'Nội dung cảnh báo',
        'handle_id' => 'Cách xử lý',
        'error_ids' => 'Lỗi',
        'error_id' => 'Lỗi',
        'spare_part_code' => 'Mã linh kiện',
        'handover_party' => 'Team planning',
        'price' => "Giá",
        'serial' => "Số serial",
        'billing' => "Số hóa đơn",
        'gracetime' => "Số tháng gia hạn",
        'customer_id' => 'Khách hàng',
        'receiver_id' => 'Người nhận',
        'received_at' => 'Ngày nhận',
        'support_note' => 'Ghi chú',
        'form_type' => 'Loại phiếu',
        'type_center' => 'Phiếu bảo hành tại trạm',
        'type_onsite' => 'Phiếu lắp đặt',
        'customer_phone' => 'Số điện thoại',
        'customer_address' => 'Địa chỉ',
        'innovation_product_id' => 'Sản phẩm đổi mới',
        'product_id' => 'Sản phẩm',
        'product_status' => 'Tình trạng ghi nhận',
        'serial_format' => 'Định dạng serial',
        'paid_at' => 'Ngày mua',
        'guarantee_status' => "Tình trạng BH",
        'installment_expenses' => 'Chi phí lắp đặt',
        'consumables_cost' => 'Chi phí vật tư phụ',
        'tech_note' => 'Ghi chú kỹ thuật',
        'psv' => 'PSV',
        'completed_at' => 'Thời gian hoàn thành',
        'fix_completed_at' => 'Thời gian hoàn thành sửa chữa',
        'payment_status' => 'Trạng thái thanh toán',
        'handle_status' => 'Trạng thái xử lý',
        'guarantee_period' => 'Thời giạn bảo hành',
        'invoice_code' => 'Số hóa đơn',
        'quantity_printed' => 'Số lần in',
        'paid' => 'Đã thanh toán',
        'quotation' => 'Đã báo giá',
        'items' => 'Sản phẩm',
        'quantity_new' => 'Số lượng tiếp nhận',
        'quantity_waiting_spare_parts' => 'Số lượng chờ linh kiện',
        'quantity_under_repair' => 'Số lượng đang sửa chữa',
        'quantity_waiting_for_progressing' => 'Số lượng chờ xử lý',
        'quantity_complete' => 'Số lượng hoàn thành',
        'total_amount_spare_part_gift' => 'Tổng giá Lk ngoài hệ thống',
        'total_amount_spare_part' => 'Tổng giá Lk từ hệ thống',
        'total_amount_spare_part_percent_discount' => 'Giảm giá LK từ hệ thống',
        'repair_cost' => 'Đơn giá chi phí sửa chữa',
        'repair_percent_discount' => 'Giảm giá chi phí sửa chữa',
        'reason_request_guarantee'=> "Lý do cho phép bảo hành",
        'reason_request_innovation'=> "Lý do cho phép đổi mới",
        'reason_request_free'=> "Lý do thay linh kiện miễn phí",

        'request_guarantee_new' => "Yêu cầu",
        'request_guarantee_cancel' => "Từ chối",
        'request_guarantee_approval' => "Duyệt",
        'started_at' => 'Thời gian bắt đầu',
    ],
];