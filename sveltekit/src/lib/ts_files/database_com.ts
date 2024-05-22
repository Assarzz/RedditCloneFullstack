import { type PostBase, type PostWithUser, type User, type CommentBase, type PostFull, type CommentFull, type CommentWithUser } from "$lib/types/contribution";

import { createCommentTreeForPost } from "./commentTree";

type FetchMode = {
  customFetch:(url:string)=>Promise<Response>,
  serverOrClient:"server"|"client"
}

export async function loadPostBases(pidStart:number, count:number, fetchMode:FetchMode = {customFetch:fetch, serverOrClient:"client"}): Promise<PostBase[]> {

    const url = fetchMode.serverOrClient == "client"? `api/getPosts.php?pidStart=${pidStart}&count=${count}`: `http://web/api/getPosts.php?pidStart=${pidStart}&count=${count}`
    const response = await fetchMode.customFetch(url);
    const postsData = await response.json()
    const postBases = []
    
    for (const postData of postsData) {

      let postBase:PostBase = {
        content:postData.post_txt,
        pid:postData.pid,
        uid:postData.uid
      }
      postBases.push(postBase)

      // // get firstname, surname, username from uid
      // const responseUser = await fetch(`/api/getUserFromUid.php?uid=${postData.uid}`)
      // const userData = await responseUser.json()

      // // get all comments to the post
      // const responseComments = await fetch(`api/getCommentsFromPid.php?pid=${postData.pid}`)
      // const commentsData = await responseComments.json()

      // //assign the userData and commentData to the postData so that i have access to it in the post element
      // Object.assign(postData,  {...userData, commentsData})
    }
    //posts = posts.concat(postsData);
    return postBases

}


export async function loadPostFulls(pidStart:number, count:number, fetchMode:FetchMode = {customFetch:fetch, serverOrClient:"client"}): Promise<{value:PostFull[]}> {

  const postBases = await loadPostBases(pidStart, count, fetchMode)

  const postFulls:PostFull[] = []
  for (const postBase of postBases){

      // get all the extra user data for the post user
      const user = await loadUser(postBase.uid, fetchMode)
      const postWithUser:PostWithUser = {
        ...postBase,
        user,
      }

      // get all comments to the post
      const commentURL = fetchMode.serverOrClient == "client"? `api/getCommentsFromPid.php?pid=${postBase.pid}`: `http://web/api/getCommentsFromPid.php?pid=${postBase.pid}`
      const responseComments = await fetchMode.customFetch(commentURL)
      const commentsData = await responseComments.json()

      const commentsWithUsers:CommentWithUser[] = []
      for (const commentData of commentsData){

        const commentBase:CommentBase = {
          cid:commentData.cid,
          content:commentData.comment_txt,
          parentCid:commentData.pcid,
          pid:commentData.pid,
          uid:commentData.uid
        }
        const userForComment:User = await loadUser(commentBase.uid, fetchMode)
        const commentWithUser:CommentWithUser = {
          ...commentBase,
          user:userForComment
        }
        commentsWithUsers.push(commentWithUser)
      }

      const postFull = createCommentTreeForPost(commentsWithUsers, postWithUser)
      postFulls.push(postFull)

  }

  return {value:postFulls}

}
export async function loadUser(uid:string,  fetchMode:FetchMode = {customFetch:fetch, serverOrClient:"client"}): Promise<User>{
  const url = fetchMode.serverOrClient == "client"? `/api/getUserFromUid.php?uid=${uid}`: `http://web/api/getUserFromUid.php?uid=${uid}`
  const response = await fetchMode.customFetch(url)
  const data = await response.json()

  const user:User = {
    firstName:data.firstname,
    lastName:data.surname,
    userName:data.username,
    uid
  }
  return user
}

export async function loadAllPostsFromUid(uid:string, fetchMode:FetchMode = {customFetch:fetch, serverOrClient:"client"}){
  const url = fetchMode.serverOrClient == "client"? `/api/getAllPostsFromUid.php?uid=${uid}`: `http://web/api/getAllPostsFromUid.php?uid=${uid}`
  const response = await fetchMode.customFetch(url)
  const data = await response.json()


  let user:User = await loadUser(uid, fetchMode)
  
  const postsWithUsers:PostWithUser[] = []
  for (const postData of data) {
    let postWithUser:PostWithUser = {
      content:postData.post_txt,
      pid:postData.pid,
      uid:postData.uid,
      user
    }
    postsWithUsers.push(postWithUser)
  }
  return postsWithUsers

}

import type { CommentUserOPComment } from "$lib/types/contribution";
export async function loadAllCommentsAndOriginalPostersFromUid(uid:string, fetchMode:FetchMode = {customFetch:fetch, serverOrClient:"client"}){

  const url = fetchMode.serverOrClient == "client"? `/api/getCommentsAndOPFromUid.php?uid=${uid}`: `http://web/api/getCommentsAndOPFromUid.php?uid=${uid}`
  const response = await fetchMode.customFetch(url)
  const data = await response.json()

  let user:User = await loadUser(uid, fetchMode)


  
  const commentUserOPComments:CommentUserOPComment[] = []
  for (const dataPoint of data) {

    let commentWithUser:CommentWithUser = {
      user,
      content:dataPoint.comment_txt,
      cid:dataPoint.cid,
      parentCid:dataPoint.pcid,
      uid:user.uid,
      pid:dataPoint.ppid,
    }
    let op:User = {
      firstName:dataPoint.parentUser.firstname,
      lastName:dataPoint.parentUser.surname,
      userName:dataPoint.parentUser.username,
      uid:dataPoint.parentUser.uid
    }
    commentUserOPComments.push({
      commentWithUser,
      op,
      op_content:dataPoint.parent_txt
    })
  }
  return commentUserOPComments
}


// const responsePosts = await fetch(`http://web/api/getAllPostsFromUid.php?uid=${params.uid}`)
// let postsData = await responsePosts.json()
// for (const postData of postsData) {
    
// }

// const response2 = await fetch(`http://web/api/getCommentsAndOPFromUid.php?uid=${params.uid}`)
// commentsData = await response2.json()
