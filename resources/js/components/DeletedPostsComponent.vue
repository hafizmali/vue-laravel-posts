// DeletedPostsComponent.vue

<template>
  <div>
      <h1>Posts</h1>
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create' }" class="btn btsn-primary">Create Post</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Content</th>
                <th>Deleted at</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="post in deletedposts" :key="post.id">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.body }}</td>
                    <td>{{ post.updated_at }}</td>
                    <td><router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" @click.prevent="restorePost(post.id)">Restore</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
      data() {
        return {
          deletedposts: []
        }
      },
      created() {
      let uri = 'http://127.0.0.1:8000/api/deletedposts';
      this.axios.get(uri).then(response => {
        this.deletedposts = response.data.data;
      });
    },
    methods: {
      restorePost(id)
      {
        let uri = `http://127.0.0.1:8000/api/post/restore/${id}`;
        this.axios.get(uri).then(response => {
          this.deletedposts.splice(this.deletedposts.indexOf(id), 1);
        });
      }
    }
  }
</script>