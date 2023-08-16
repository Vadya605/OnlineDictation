import { isClickButtonVideo } from "../../utils/domHelpers"

document.addEventListener('click', e => {
    if(isClickButtonVideo(e)){
        const videoLink = e.target.getAttribute('data-video-link')
        const videoFrame = document.querySelector('#modalVideo iframe')

        videoFrame.src = videoLink
    }
})