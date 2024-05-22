/**
 * Kontroll om man är inloggad eller ej
 * @returns "auth": true/false,"userdata": {"uid": ..., "firstname": ..., "surname": ...}
 */


export async function auth() {
   let result:{auth:boolean, uid:string|null} = {"auth": false, uid:null};

   try {
      const response = await fetch("/api/auth.php");
      const data = await response.json();
      result.auth = data.auth
      result.uid = data.userdata.uid
   } catch (e) {}

   return result;
}