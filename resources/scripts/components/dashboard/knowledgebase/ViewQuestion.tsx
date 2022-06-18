import React, {useEffect} from "react";
import {RouteComponentProps, useRouteMatch} from "react-router-dom";
import useFlash from "@/plugins/useFlash";
import useSWR from "swr";
import {question} from "@/api/knowledgebase";
import PageContentBlock from "@/components/elements/PageContentBlock";
import {faBook} from "@fortawesome/free-solid-svg-icons";
import tw from "twin.macro";
import Spinner from "@/components/elements/Spinner";
import TitledGreyBox from "@/components/elements/TitledGreyBox";
import ContentBox from "@/components/elements/ContentBox";

const ViewQuestion = () => {
    const match = useRouteMatch<{ id: string }>();
    const { clearFlashes, clearAndAddHttpError } = useFlash();
    const { data, error } = useSWR('/knowledgebase/question', () => question(parseInt(match.params.id)));

    useEffect(() => {
        if (!error) clearFlashes('knowledgebase'); else clearAndAddHttpError({ key: 'knowledgebase', error })
    });

    return (
        <PageContentBlock title={'Knowledgebase'} showFlashKey={'knowledgebase'}>
            {!data ?
                <div css={tw`w-full`}>
                    <Spinner size={'large'} centered/>
                </div>
                :
                <div css={tw`w-full flex flex-wrap`}>
                    <TitledGreyBox title={'Information'} css={tw`w-full md:w-1/4`}>
                        <strong>Subject:</strong> {data.subject}<br/>
                        <strong>Author:</strong> {data.author}<br/>
                        <strong>Updated:</strong> {data.updated_at}<br/>
                        <strong>Created:</strong> {data.created_at}<br/>
                    </TitledGreyBox>
                    <ContentBox css={tw`w-full mt-4 md:mt-0 md:ml-4 md:w-73/100`}>
                        <span dangerouslySetInnerHTML={{ __html: data.information }}/>
                    </ContentBox>
                </div>
            }
        </PageContentBlock>
    )
};

export default ViewQuestion;
