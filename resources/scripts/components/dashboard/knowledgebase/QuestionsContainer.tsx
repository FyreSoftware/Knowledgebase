import React, {useEffect} from 'react';
import {Link, useRouteMatch} from "react-router-dom";
import useFlash from "@/plugins/useFlash";
import PageContentBlock from "@/components/elements/PageContentBlock";
import useSWR from "swr";
import {Question, questions} from "@/api/knowledgebase";
import {faBook} from "@fortawesome/free-solid-svg-icons";
import tw from "twin.macro";
import Spinner from "@/components/elements/Spinner";
import MessageBox from "@/components/MessageBox";
import GreyRowBox from "@/components/elements/GreyRowBox";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

const QuestionsContainer = () => {
    const match = useRouteMatch<{ id: string }>();
    const { clearFlashes, clearAndAddHttpError } = useFlash();
    const { data, error } = useSWR('/knowledgebase/questions', () => questions(parseInt(match.params.id)));

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
                <>
                    {!data.length ?
                        <MessageBox type={'info'} title={'Info'}>
                            There are no questions.
                        </MessageBox>
                        :
                        <div css={tw`w-full`}>
                            {data.map((question: Question) => (
                                <GreyRowBox as={Link} to={`/knowledgebase/view/${question.id}`} css={tw`mb-2`}>
                                    <div css={tw`hidden sm:block`}>
                                        <FontAwesomeIcon icon={faBook} fixedWidth/>
                                    </div>
                                    <div css={tw`flex flex-auto justify-between`}>
                                        <div css={tw`sm:ml-8 text-center`}>
                                            <p css={tw`text-sm`}>{question.author}</p>
                                            <p css={tw`mt-1 text-2xs text-neutral-300 uppercase select-none`}>Author</p>
                                        </div>
                                        <div css={tw`text-center`}>
                                            <p css={tw`text-sm`}>{question.subject}</p>
                                            <p css={tw`mt-1 text-2xs text-neutral-300 uppercase select-none`}>Subject</p>
                                        </div>
                                        <div css={tw`text-center`}>
                                            <p css={tw`text-sm`}>{question.updated_at}</p>
                                            <p css={tw`mt-1 text-2xs text-neutral-300 uppercase select-none`}>Updated</p>
                                        </div>
                                    </div>
                                </GreyRowBox>
                            ))}
                        </div>
                    }
                </>
            }
        </PageContentBlock>
    )
}

export default QuestionsContainer;