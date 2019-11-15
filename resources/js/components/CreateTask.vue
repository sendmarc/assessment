<template>
  <div>
    <h5 class="my-4">Create a task</h5>

    <form>
      <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control">
      </div>

      <div class="form-group">
          <label for="">Priority</label>
          <input type="text" class="form-control">
      </div>

      <div class="form-group">
          <label for="">Due In</label>
          <input type="text" class="form-control">
      </div>

      <div class="form-group">
          <button class="btn btn-primary">Save</button>
          <a href="#" class="btn btn-danger">Cancel</a>
      </div>
    </form>
  </div>
</template>

<script>
export default {};
</script>