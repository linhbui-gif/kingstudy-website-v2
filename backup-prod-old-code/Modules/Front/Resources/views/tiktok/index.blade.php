<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TikTok</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div>
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="js-popup">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form action="{{ route('api_content_tiktok_save')  }}" class="js-form-tiktok" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <label class="font-medium text-gray-800">Nội dung video</label>
                        <textarea class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" name="content" ></textarea>
                        <label class="font-medium text-gray-800">Tên sản phẩm</label>
                        <input type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" name="product_name">
                        <label class="font-medium text-gray-800">Video Link</label>
                        <input type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" name="link_video">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nội dung này thuộc về kênh</label>
                        <select id="countries" name="source_chanel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Chọn kênh</option>
                            <option value="1">Thongminhmartstore</option>
                            <option value="2">lina.buishop</option>
                        </select>
                    </div>
                    <div class="bg-gray-200 px-4 py-3 flex justify-end">
                        <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal()"><i class="fas fa-times"></i> Cancel</button>
                        <button type="submit" class="py-2 px-4 flex justify-center items-center  bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg max-w-md">
                            <div class="js-icon-loading">
                                <svg width="20" height="20" fill="currentColor" class="mr-2 animate-spin" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M526 1394q0 53-37.5 90.5t-90.5 37.5q-52 0-90-38t-38-90q0-53 37.5-90.5t90.5-37.5 90.5 37.5 37.5 90.5zm498 206q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-704-704q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm1202 498q0 52-38 90t-90 38q-53 0-90.5-37.5t-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-964-996q0 66-47 113t-113 47-113-47-47-113 47-113 113-47 113 47 47 113zm1170 498q0 53-37.5 90.5t-90.5 37.5-90.5-37.5-37.5-90.5 37.5-90.5 90.5-37.5 90.5 37.5 37.5 90.5zm-640-704q0 80-56 136t-136 56-136-56-56-136 56-136 136-56 136 56 56 136zm530 206q0 93-66 158.5t-158 65.5q-93 0-158.5-65.5t-65.5-158.5q0-92 65.5-158t158.5-66q92 0 158 66t66 158z">
                                    </path>
                                </svg>
                            </div>
                            Tạo mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container mx-auto px-4 sm:px-8">

    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Danh Sách Nội dung TikTok</h2>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mb-2 js-show-modal">
                Tạo mới
            </button>
            <div
                class="inline-block min-w-full shadow-md rounded-lg overflow-hidden relative"
            >
                <div class="spinner absolute top-0 left-0 w-full h-full flex items-center justify-center z-10 bg-[#ffffffab] js-spinner">
                    <div role="status">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <table class="min-w-full leading-normal ">
                    <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                        >
                            Nội dung cho video
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                        >
                            Tên sản phẩm
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                        >
                            Video Link
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                        >
                            Hash Tag
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                        >
                            Thuộc về kênh
                        </th>
                    </tr>
                    </thead>
                    <tbody id="js-table-content-tiktok">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/frontend/assets/js/jquery.min.js') }}"></script>
<script>
    function ajax_loading(show) {
        if (show) {
            $('.js-spinner').show();
        } else {
            $('.js-spinner').hide();
        }
    }

    function request_ajax(url, data, method, done_callback) {
        ajax_loading(true);

        $.ajax({
            method: method,
            url: url,
            dataType: 'json',
            data: data
        })
            .done(function (res) {
                ajax_loading(false);
                done_callback(res)
            })
            .fail(function (res) {
                ajax_loading(false);

                if (res.status == 403) {
                    show_pnotify('Bạn không có quyền thực hiện tính năng này. Vui lòng liên hệ Admin!');
                } else if (res.status == 419) {
                    location.reload();
                } else {
                    if (done_callback) {
                        return done_callback(res.responseJSON);
                    }
                }
            });
        return false;
    }
    function getListContent() {
        const url = '{{ route('api_content_tiktok') }}'
        request_ajax(url, {}, "GET", function (res) {
            ajax_loading(false);
            if(res?.code === 200) {
                const data = res?.data;
                $("#js-table-content-tiktok").html(data)
            }
        });
    }
    function toggleModal() {
        document.getElementById('js-popup').classList.toggle('hidden')
    }
    document.querySelector('.js-show-modal').addEventListener('click', toggleModal)
    const copyText = (e) => {
        const clicked = e.target;
        if(clicked && clicked.classList.contains('js-copy-text')) {
            const temp = $("<input>");
            $("body").append(temp);
            temp.val(clicked.textContent).select();
            document.execCommand("copy");
            temp.remove();
            alert('Copied')
        }
    };
    const copyWrapper = document.querySelector("#js-table-content-tiktok");
    copyWrapper.addEventListener("click", (e) => copyText(e));
    getListContent()
    $('.js-icon-loading').hide();
    $("form.js-form-tiktok").submit(function(e){
        e.preventDefault();
        let formData = jQuery(".js-form-tiktok").serializeArray();
        $('.js-icon-loading').show();
        jQuery.ajax({
            url: jQuery(".js-form-tiktok").attr('action'),
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(data) {
                if(data?.code === 200) {
                    $('.js-icon-loading').hide();
                    document.getElementById('js-popup').classList.add('hidden')
                    $("form.js-form-tiktok").trigger("reset");
                    getListContent()
                }

            }
        });
    });
</script>
</body>
</html>
