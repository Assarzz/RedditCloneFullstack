<script>
   import { user } from "$lib/stores/user.js";
   import { goto } from "$app/navigation";
   import { page } from "$app/stores";
    import Search from "./Search.svelte";


    // tar tusen år. inte så effektivet svelte :(
    import HomeIcon from "./svgIcons/HomeIcon.svelte"
    import FriendIcon from "./svgIcons/FriendIcon.svelte";
    import LogOutIcon from "./svgIcons/LogOutIcon.svelte";
    import SearchIcon from "./svgIcons/SearchIcon.svelte";
    import SettingsIcon from "./svgIcons/SettingsIcon.svelte";
    import UserIcon from "./svgIcons/UserIcon.svelte";
    



   async function signOut() {
      if ($user.auth) {
         let response = await fetch("/api/signout.php");

         $user = await response.json();
         goto("/login");
      }
   }

   import { onMount } from "svelte";
   
   let navItems = []
   let currentMouseDown
   onMount(()=>{
      navItems =[
      {text:"Home", icon:HomeIcon, onClick:()=>{goto("/")}},
      {text:$user.userdata.firstname + " " + $user.userdata.surname, icon:UserIcon,onClick:()=>{goto(`/users/${$user.userdata.uid}`)}},
      {text:"Friends", icon:FriendIcon, onClick:()=>{}},
      {text:"Search", icon:SearchIcon, onClick:()=>{}},
      {text:"Settings", icon:SettingsIcon, onClick:()=>{}},
      {text:"Log Out", icon:LogOutIcon, onClick:signOut}]

      navItems.forEach(element => {
         element.displayText = false
      });
   })

    const MouseEnter = async function(index){

    }
    const MouseLeave = async function(index){

   }
</script>

<nav>

   <ul>
      {#each navItems as item, index}

      <li>
         <button id="buttion" on:click={item.onClick} on:mouseenter={()=>{MouseEnter(index)}} on:mouseleave={()=>{MouseLeave(index)}}>
            
            <svelte:component this={item.icon} details={{width:"2em", height:"2em"}}></svelte:component>
            <p style="font-size: 1em ;">{item.text}</p>

         </button>
      </li>

   {/each}
   </ul>

   <!-- <ul>
      <li>
         <a href="/" class:active={"/" === $page.url.pathname}>
            {$user.userdata.firstname + " " + $user.userdata.surname}
         </a>
      </li>
      <li>
         <a href="/flow/{$user.userdata.uid}"
            class:active={$page.url.pathname.startsWith("/flow")}>Flöde</a>
      </li>
      <li>
         <a href="/friends" class:active={"/friends" === $page.url.pathname}>Vänner</a>
      </li>
      <li>
         <a href="/settings" class:active={"/settings" === $page.url.pathname}>
            Inställningar</a>
      </li>
   </ul> -->


</nav>



<!-- <style lang="scss">
   nav {
      position: relative;
      display: inline;
      margin-left: 2rem;

      ul {
         list-style-type: none;
         display: inline;

         li {
            margin-left: 1rem;
            display: inline;

            a {
               display: inline-block;
               padding: 6px;
               border-bottom: 1px solid rgb(124, 10, 10);
               font-size: 1.4rem;
               text-decoration: none;
               color: white;
               background-color: black;

               &:hover {
                  border-bottom: 1px solid red;
                  color: #ffffff;
               }

               &.active {
                  border-bottom: 1px solid red;
                  color: #ffffff;
               }
            }
         }
      }
   }

   button {

      background-color: transparent;
      border: none;

      img {
         width: 14px;
         height: auto;
      }

      &.sign {
         border: none;
         border-radius: 4px;
         padding: 5px 15px;
         text-decoration: none;
         color: white;
         background-color: rgb(124, 10, 10);
         margin-left: 1.8rem;

         img {
            display: none;
         }

         &:hover {
            background-color: gray;
         }

         &::after {
            content: "Logga Ut";
         }
      }

      &:hover {
         cursor: pointer;
      }

      img {
         width: 28px;
         margin-bottom: -10px;
         &:hover {
            opacity: 0.5;
         }
      }
   }

   form {
      display: inline;
      margin-bottom: 0.7rem;

      input[type="text"] {
         margin-top: 0.5rem;
         margin-left: 1.5em;
         font-size: 1.4rem;
         width: 20rem;
      }
   }

   @media only screen and (max-width: 1024px) {
      nav {
         position: absolute;
         display: block;
         bottom: 5px;
         margin-left: 5px;

         li {
            margin-left: 0.4rem;
            display: inline;
         }
      }
   }

   @media only screen and (max-width: 675px) {
      input,
      button.search {
         display: none;
         margin-top: 1rem;
         justify-content: right;
      }

      button.sign {
         margin-left: 2.6rem;
         padding: 0;
         background-color: transparent;
         position: absolute;
         right: 15px;
         top: 15px;
         &:hover {
            background-color: transparent;
            color: alpha($color: #000000);
         }

         &::after {
            content: none;
         }

         img {
            display: inline;
         }
      }

      button.search {
         display: none;
      }

      nav {
         ul {
            li {
               margin-left: 0.3rem;
            }
         }
      }
   }
</style> -->
<style lang="scss">

nav ul{
   display: flex;
   justify-content: space-around;
   gap: 5px;
   height: 100%;
   width: 100%;
   margin: 0;
   padding: 0;


   &*{
      color: white;
   }
   &li{
      margin: 0;
      padding: 0;
      flex-grow: 1;


   }

}
#buttion{
   padding-left: 9px;
   padding-right: 9px;
   border-radius: 20px;

   display: flex;
   gap: 3px;
   justify-content: center;
   align-items: center;

   background-color: $mainDark1;
   color: $mainLight4;
   text-decoration: none;
   border: none;



   &:hover{
      background-color: rgba(169, 169, 169, 0.337);
   }
}

#logOut{
   display: flex;
   justify-content: center;
   align-items: center;
   background-color: red;
   
}

ul{
   display: flex;
   
}

</style>