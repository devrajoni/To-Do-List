<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.5/dataRender/datetime.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
	crossorigin="anonymous"></script>
<script src="https://unpkg.com/phosphor-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
	$(document).ready(function() {
		$('#userIds').select2({
			placeholder: "Select users",
			allowClear: true
		});

		$('#assignUserModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var taskId = button.data('task-id');
			var modal = $(this);
			modal.find('#taskId').val(taskId);
		});
	});

	$(document).ready(function() {
		$('.mark-complete').on('click', function(e) {
			e.preventDefault();
			var taskId = $(this).data('task-id');
			$.ajax({
				url: '/tasks/' + taskId + '/complete',
				method: 'POST',
				data: {
					_token: '{{ csrf_token() }}' 
				},
				success: function(response) {
					$('#task-row-' + taskId + ' td:nth-child(5)').html('<span class="badge badge-success">Completed</span>');
					$('#task-row-' + taskId + ' td:last-child').html('<span class="badge badge-success">Completed</span>');
					alert('Task marked as complete.');
				},
				error: function(xhr) {
					alert('An error occurred while marking the task as complete. Please try again.');
				}
			});
		});
	});
</script>

@yield('scripts')