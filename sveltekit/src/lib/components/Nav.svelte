<script lang="ts">
   import { user } from "$lib/stores/user";
   import { goto, invalidate, replaceState } from "$app/navigation";
 
    // tar tusen år. inte så effektivet svelte :(
    import HomeIcon from "./svgIcons/HomeIcon.svelte"
    import FriendIcon from "./svgIcons/FriendIcon.svelte";
    import LogOutIcon from "./svgIcons/LogOutIcon.svelte";
    import SearchIcon from "./svgIcons/SearchIcon.svelte";
    import SettingsIcon from "./svgIcons/SettingsIcon.svelte";
    import UserIcon from "./svgIcons/UserIcon.svelte";
    
   async function signOut() {
      if ($user.auth) {
         // destroys session 
         await fetch("/api/signout.php");

         // reset authentication store
         console.log({...$user}, "before reset")
         user.set({ user: null, auth: false })
         console.log({...$user}, "after reset")
         goto("/login");
      }
   }
   

   type NavItem ={
      text:string,
      icon:any,
      onClick:()=>void,
      displayText:boolean
   }

   let currentMouseDown

      const navItems:NavItem[] =[
      {displayText:false, text:"Home", icon:HomeIcon, onClick:()=>{goto("/")}},
      {displayText:false, text:$user.user?.firstName + " " + $user.user?.lastName, icon:UserIcon,onClick:()=>{goto(`/users/${$user.user?.uid}`)}},
      {displayText:false, text:"Friends", icon:FriendIcon, onClick:()=>{}},
      //{displayText:false, text:"Search", icon:SearchIcon, onClick:()=>{}},
      {displayText:false, text:"Settings", icon:SettingsIcon, onClick:()=>{}},
      {displayText:false,text:"Log Out", icon:LogOutIcon, onClick:signOut}]

    const MouseEnter = async function(index:number){

    }
    const MouseLeave = async function(index:number){

   }
   let content = ""
    async function submitForm() {
        const response = await fetch(`/api/getUserFromUsername.php?username=${content}`)
        const user = await response.json()
        if (!response.ok) {
         goto(`/users/${content}`)
            return
        }
        goto(`/users/${user.uid}`)
    }
</script>

<nav>

   <ul>

      <li>
         <button class="button" id="search">
            
            <SearchIcon  details={{width:"2em", height:"2em"}}></SearchIcon>

            <p style="font-size: 1em ;">Search</p>

            <form on:submit|preventDefault={submitForm} method="post" id="contentForm">
               <input type="search" style="color: black;" bind:value={content}>
           </form>

         </button>
      </li>
      {#each navItems as item, index}

      <li>
         <button class="button" on:click={item.onClick} on:mouseenter={()=>{MouseEnter(index)}} on:mouseleave={()=>{MouseLeave(index)}}>
            
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
.button{
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

#search{
   *{
      margin: 5px;
      
   }
   input{
   color: $mainDark1;
   border-radius: 10px;
   padding: 3px;
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