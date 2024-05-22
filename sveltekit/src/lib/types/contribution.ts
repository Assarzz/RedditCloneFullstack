export type User = {
    firstName:string,
    lastName:string,
    uid:string,
    userName:string
  }
export type CommentBase = {
    content:string,
    uid:string,
    cid:number,
    pid:number
    parentCid:number|null
}
export type CommentWithUser = CommentBase & {
    user:User,
  }
export type CommentFull = CommentWithUser & {
  directChildren:CommentFull[],
  //parent:CommentFull|PostWithUser,
}

export type PostBase = {
    pid:number,
    content:string,
    uid:string,
  }


export type PostWithUser = PostBase &{
    user:User,
}
export type PostFull = PostWithUser & {
  directChildren:CommentFull[]
}

//export type Contribution = {post:PostFull} | {comment:CommentFull, layer:number}
export type Contribution = PostFull| CommentFull

export type CommentUserOPComment = {
  commentWithUser:CommentWithUser,
  op:User,
  op_content:string
}