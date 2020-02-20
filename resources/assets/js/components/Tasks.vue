<template>
    <div class="task">
        <div class="col-1">
            <button @click="del">Delete</button>
			<button @click="tick">Tick</button>
		</div>
        <div class="col-2">
            <h3>Name: {{ name | properCase }}</h3>
            
			<p><strong>Priority:</strong> {{ priority }}<br /><strong>Due in:</strong> {{ dueIn }} days</p>
        </div>
    </div>
</template>
<script>
  export default {
    methods: {
      del() {
        this.$emit('delete', this.id);
      },
	  tick() {
        this.$emit('ticker', this.id);
      }
    },
    props: ['id', 'name', 'priority', 'dueIn'],
    filters: {
      properCase(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
    }
  }
</script>
<style>
	#app {
		margin-left: auto;
		margin-right: auto;
		text-align: center;
	}
    .task {
        display: flex;
        margin: 10px auto;
        border: 1px solid #d1d1d1;
        padding: 1em;
        max-width: 350px;
		border-radius: 6px;
        background-color: #676464;
    }
	.heading h1 {
		color: #716656;
	}
    .col-2 {
		text-align: left;
        margin-left: 16%;
    }

    .col-2 > h3 {
		color: aliceblue;
        margin: 0.5em 0;
    }
	.col-2 > p {
		color: aliceblue;
	}
	button {
		border-radius: 6px;
		background: white;
		color: red;
		padding: 5px 10px;
		border: 0;
		display: block;
		margin: 15px auto;
		cursor: pointer;
	}
	.col-1 button {
		width: 100%;
	}
	select {
		padding: 4px;
		border: 0;
		border-radius: 6px;
	}
</style>
