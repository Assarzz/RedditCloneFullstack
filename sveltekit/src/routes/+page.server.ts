import type { PageServerLoad } from './$types'
import { loadPostFulls } from '$lib/ts_files/database_com'
import type {PostFull, User} from "$lib/types/contribution"



export const load:PageServerLoad = async ({fetch, url}) => {
    const posts = await loadPostFulls(1, 2, {customFetch:fetch, serverOrClient:"server"});
    console.log("posts in +page.server.ts", posts)
    return posts

    // const testPosts = await fetch("/testApi?count=2")
    // const testPostsJson:PostFull[] = await testPosts.json()
    // return {value:testPostsJson}

}
// the things we need to do before the dom gets constructed. in other words the things that are established here 

