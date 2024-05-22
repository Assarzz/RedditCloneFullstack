import type {PostFull, User} from "$lib/types/contribution"
import { count } from "console"
import type { RequestHandler } from "./$types"

export const GET:RequestHandler = ({url})=>{

    if (!url.searchParams.has("count")) {
        return new Response("missing count in query", {status:400})
    }

    const count = Number.parseInt(url.searchParams.get("count")!)!

    const firstNames = ["John", "Jane", "Jack", "Jill", "James", "Jenny", "Jared", "Jasmine", "Jasper", "Jade"]
    const lastNames = ["Smith", "Johnson", "Williams", "Jones", "Brown", "Davis", "Miller", "Wilson", "Moore", "Taylor"]
    const userNames = ["johndoe", "janedoe", "jackdoe", "jilldoe", "jamesdoe", "jennydoe", "jareddoe", "jasminedoe", "jasperdoe", "jadedoe"]

    const contents = ["test content", "test content 2", "test content 3", "test content 4", "test content 5", "test content 6", "test content 7", "test content 8", "test content 9", "test content 10"]
    const uids = ["the uid", "the uid 2", "the uid 3", "the uid 4", "the uid 5", "the uid 6", "the uid 7", "the uid 8", "the uid 9", "the uid 10"]

    const createdPostFulls = []
    for(let i = 0; i < count; i++){

        const user:User = {uid:getRandomFromList(uids), firstName:getRandomFromList(firstNames), lastName:getRandomFromList(lastNames), userName:getRandomFromList(userNames)}
        const postFull:PostFull = {content:getRandomFromList(contents), directChildren:[], pid:123, uid:getRandomFromList(uids), user:user}
        createdPostFulls.push(postFull)
    }
    return new Response(JSON.stringify(createdPostFulls))

}

function getRandomFromList(list:string[]){
    return list[Math.floor(Math.random() * list.length)]
}