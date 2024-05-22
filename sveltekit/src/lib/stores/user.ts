/**
 * Användarinformation som behövs i komponenter och på sidor.
 */
import { writable } from 'svelte/store';
import type {Authentication } from '$lib/types/authentication';

const authentication:Authentication = {auth:false, user:null};
export const user = writable(authentication);