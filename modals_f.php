<?php 
function render_modal($id,$labelId)
{
	if(!isset($id))$id='buyModalId';
	if(!isset($labelId))$labelId='buy-ModalLabel';
	$str = '
		<!-- *********************************************** -->

<!--button type="button" class="btn btn-primary buy-token" data-toggle="modal" data-target="#'.$id.'" data-whatever="@mdo">Open modal for @mdo</button-->

<div class="modal fade " id="'.$id.'" tabindex="-1" aria-labelId="'.$labelId.'" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="'.$labelId.'">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-target="#'.$id.'">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary btn-target-text">Купить</button>
      </div>
    </div>
  </div>
</div>

<!-- *********************************************** -->
	';
	$tstr = '
	<!-- Button trigger modal -->
<!--button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#'.$id.'">
  Launch demo modal
</button-->

<!-- Modal -->
<div class="modal fade" id="'.$id.'" tabindex="-1" aria-labelId="'.$labelId.'" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="'.$labelId.'">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-target-text">Купить</button>
      </div>
    </div>
  </div>
</div>
	';
	return $tstr;
}

?>