{{-- Add Modal --}}
<div class="modal fade" id="detailNews" tabindex="-1" aria-labelledby="detailNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailNewsModalLabel">Chi tiết bài viết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                        
                        <div class="col">
                            <h3 style="padding-bottom: 0;" class="card-title">Chủ đề: <span style="font-size: 25px;" id="detail-news-category-id" class="card-title"></span></h3>
                            <h5 id="detail-news-title" class="card-title"></h5>
                            <img id="detail-news-image" src="" class="card-img-top" alt="...">
                            
                            <div class="card-body">
                                <div id="detail-news-content" style="white-space: pre-wrap;" class="card-text"></div>
                            </div>
                        <p class="card-text">Người viết: <span id="detail-news-user"></span></p> 
                        <p class="card-text">Ngày viết: <span id="detail-news-created-at"></span></p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span data-bs-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary">Đóng</span>
                    </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
              
</div>
