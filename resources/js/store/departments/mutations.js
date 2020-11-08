export function someMutation (/* state */) {
}
export const setIsLoggedIn = (state, status) => {
  state.isLoggedIn = status
}
export const setUser = (state, user) => {
  state.user = user
}
export const changeCurrentDepartment = (state, department) => {
    state.current_department = department
}
