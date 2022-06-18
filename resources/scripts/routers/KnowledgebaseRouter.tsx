import React from "react";
import {NavLink, Switch} from "react-router-dom";
import NavigationBar from "@/components/NavigationBar";
import SubNavigation from "@/components/elements/SubNavigation";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faBook} from "@fortawesome/free-solid-svg-icons";
import TransitionRouter from "@/TransitionRouter";
import {Route, useLocation} from "react-router";
import KnowledgebaseContainer from "@/components/dashboard/knowledgebase/KnowledgebaseContainer";
import QuestionsContainer from "@/components/dashboard/knowledgebase/QuestionsContainer";
import ViewQuestion from "@/components/dashboard/knowledgebase/ViewQuestion";
import {NotFound} from "@/components/elements/ScreenBlock";

export default () => {
    const location = useLocation();

    return (
        <>
            <NavigationBar/>
            {location.pathname.startsWith('/knowledgebase') &&
                <SubNavigation>
                    <div>
                        <NavLink to={'/knowledgebase'}><FontAwesomeIcon icon={faBook}/> Knowledgebase</NavLink>
                    </div>
                </SubNavigation>
            }
            <TransitionRouter>
                <Switch location={location}>
                    <Route path={'/knowledgebase'} exact>
                        <KnowledgebaseContainer/>
                    </Route>
                    <Route path={'/knowledgebase/list/:id'} exact>
                        <QuestionsContainer/>
                    </Route>
                    <Route path={'/knowledgebase/view/:id'} exact>
                        <ViewQuestion/>
                    </Route>
                    <Route path={'*'} component={NotFound}/>
                </Switch>
            </TransitionRouter>
        </>
    )
}
