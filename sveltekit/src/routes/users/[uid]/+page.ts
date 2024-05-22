export const ssr = false;
import type { PageLoad } from "./$types";

import {loadAllPostsFromUid, loadUser, loadAllCommentsAndOriginalPostersFromUid} from "$lib/ts_files/database_com"
import type { PostFull, PostWithUser, User, CommentUserOPComment } from "$lib/types/contribution.js";


export const load:PageLoad =  async({params})=>{

    let user:User = await loadUser(params.uid, {customFetch:fetch, serverOrClient:"client"})
    let posts:PostWithUser[] = await loadAllPostsFromUid(params.uid, {customFetch:fetch, serverOrClient:"client"})
    let commentUserOPComments:CommentUserOPComment[] = await loadAllCommentsAndOriginalPostersFromUid(params.uid, {customFetch:fetch, serverOrClient:"client"})

    console.log("this should run every page reload")
    return {user, posts, commentUserOPComments}
} 



// import type { PageServerLoad } from "./$types";

// import {loadAllPostsFromUid, loadUser, loadAllCommentsAndOriginalPostersFromUid} from "$lib/ts_files/database_com"
// import type { PostFull, PostWithUser, User, CommentUserOPComment } from "$lib/types/contribution.js";


// export const load:PageServerLoad =  async({params, fetch})=>{

//     let user:User = await loadUser(params.uid, {customFetch:fetch, serverOrClient:"server"})
//     let posts:PostWithUser[] = await loadAllPostsFromUid(params.uid, {customFetch:fetch, serverOrClient:"server"})
//     let commentUserOPComments:CommentUserOPComment[] = await loadAllCommentsAndOriginalPostersFromUid(params.uid, {customFetch:fetch, serverOrClient:"server"})

//     return {user, posts, commentUserOPComments}
// } 


