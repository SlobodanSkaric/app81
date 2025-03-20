import { createBrowserRouter } from "react-router-dom";
import DefaultLayout from "./components/DefaultLayout";
import Moves from "./views/Moves";
const router = createBrowserRouter([
    {
        path: "/",
        element: <DefaultLayout/>,
        children:[
            {
                path:"/",
                element:<Moves/>
            }
        ]
    }
])

export default router;