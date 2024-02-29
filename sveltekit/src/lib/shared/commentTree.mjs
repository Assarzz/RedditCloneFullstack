class CommentTree{

    #root
    constructor(commentsData){

        // requires commentsData to be array of objects with the properties cid, pcid

        const nodeMap = {}; // {cid: 2, comment: comment}
        this.#root = {parent:null, children:[]}
      
        commentsData.forEach(comment => {
            comment.children = [];
            nodeMap[comment.cid] = comment;
          });

          commentsData.forEach(comment => {
            if (comment.pcid) {
              const parent = nodeMap[comment.pcid];
              if (parent) {
                parent.children.push(comment);
              } 
            }
            else{
              this.#root.children.push(comment)

            }
          });

    }

    get getRoot(){
        return this.#root
    }




}

export {CommentTree}