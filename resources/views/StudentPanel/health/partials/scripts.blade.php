<script>
  document.querySelectorAll('.health-tab').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.health-tab').forEach(b => {
        b.classList.remove('bg-indigo-600', 'text-white');
        b.classList.add('text-gray-600');
      });
      btn.classList.add('bg-indigo-600', 'text-white');
      btn.classList.remove('text-gray-600');
      document.querySelectorAll('.health-panel').forEach(p => p.classList.add('hidden'));
      document.getElementById('tab-' + btn.dataset.tab).classList.remove('hidden');
    });
  });

  const profileView = document.getElementById('profileView');
  const profileForm = document.getElementById('profileForm');
  const toggleEdit = () => { profileView.classList.toggle('hidden'); profileForm.classList.toggle('hidden'); };
  document.getElementById('toggleProfileEdit')?.addEventListener('click', toggleEdit);
  document.getElementById('cancelProfileEdit')?.addEventListener('click', toggleEdit);
  document.getElementById('toggleApptForm')?.addEventListener('click', () => document.getElementById('apptForm').classList.toggle('hidden'));
  document.getElementById('toggleDocForm')?.addEventListener('click', () => document.getElementById('docForm').classList.toggle('hidden'));
  @if ($errors->any()) toggleEdit(); @endif
</script>
