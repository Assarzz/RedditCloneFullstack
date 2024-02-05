<script>
   /**
    * Data som kommer in i komponenten
    * <Post post = {...} />
    */  
    export let post;

   // {
   //    "pid": 1,
   //    "uid": "956eef04-c402-11ee-b2a4-0242ac150003",
   //    "post_txt": "Hello I am Bert Berticus. Praise my name here!",
   //    "date": "2024-02-05 08:56:05"
   // },
</script>

<article>
   <h1>{post.user.username}</h1>
   <p>{post.post_txt}</p>
</article>

<style lang="scss">
   article {
      border-bottom: 1px solid black;
      display: block;
      width: 100%;
      padding: 4px;
      margin-top: 6px;
      margin-bottom: 6px;
      background-color: white;

      p {
         font-size: 1.6rem;
      }
   }
</style>
