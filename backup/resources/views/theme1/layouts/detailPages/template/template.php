<script id="commentView" type="text/jsrender">
    <div class="xs:flex card-view-{{:id}} border-b py-5">
<div class="w-20 h-20 min-w-[80px] rounded-full overflow-hidden xs:mr-5 xs:mb-0 mb-4">
    <img src="{{:image}}" class="w-full h-full object-cover" loading="lazy"/>
</div>
<div class="">
    <p class="text-base font-semibold mb-1 line-clamp-1">
    {{:name}}
    </p>
    <span class="text-gray-200 text-xs font-medium">{{:time}}</span>
    <p class="text-gray-200 text-sm font-medium line-clamp-2">
    {{:comment}}
    </p>
</div>
<div class="ml-auto pr-5">
    <button class="delete-btn fs-14 text-danger delete-comment-btn-tailwind text-red-500"
    data-id="{{:id}}">
    <i class="fa fa-trash-can"></i><?php echo __('messages.delete') ?>
    </button>
</div>
                            </div>
</script>
