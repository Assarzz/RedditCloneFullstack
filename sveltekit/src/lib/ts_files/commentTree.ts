import { type CommentFull, type PostWithUser, type PostFull, type CommentBase, type CommentWithUser } from "$lib/types/contribution";
import type { Key } from "readline";



/**
 * the function takes an unfinished postFull without children and adds the children in a tree structure
 * 
 * @param commentsWithUser commentBases that must fyfill the criteria of having the same pid parameter which should correspond with the postFull argument
 * @param postFull 
 */
export function createCommentTreeForPost(commentsWithUser:CommentWithUser[], postWithUser:PostWithUser): PostFull{
  const nodeMap:{[key:number]:CommentFull} = {}

  const commentsFull = commentsWithUser.map((e) => {
    const commentFull:CommentFull = {
      ...e,
      directChildren:[]
    }
    return commentFull
  })
  const root:PostFull = {
    ...postWithUser,
    directChildren:[]
  }

  // place all the comments in the map so we can easily see the parent child relationships
  commentsFull.forEach(comment => {
      nodeMap[comment.cid] = comment;
    });

    commentsFull.forEach(comment => {
      if (comment.parentCid) {
        const parent = nodeMap[comment.parentCid];
        if (parent) {
          parent.directChildren.push(comment);
        } 
      }
      else{
        root.directChildren.push(comment)

      }
    });

    return root
}
